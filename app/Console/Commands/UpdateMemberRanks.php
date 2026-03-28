<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Rank;
use App\Models\Commission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateMemberRanks extends Command
{
    protected $signature = 'mlm:update-ranks
                            {--user=   : Run for a specific user ID only}
                            {--dry-run : Preview upgrades without saving}';
    // Run for all members
    // php artisan mlm:update-ranks

    // # Preview without saving
    // php artisan mlm:update-ranks --dry-run

    // # Run for one specific member
    // php artisan mlm:update-ranks --user=42

    // # Combine — preview a specific user verbosely
    // php artisan mlm:update-ranks --user=42 --dry-run --verbose

    protected $description = 'Check all members against rank criteria and upgrade where eligible';

    private int $checked  = 0;
    private int $upgraded = 0;
    private int $skipped  = 0;

    public function handle(): int
    {
        if (! config('mlm.ranks.auto_rank_upgrade', true)) {
            $this->warn('Auto rank upgrade is disabled in config/mlm.php. Use --force or enable it first.');
            return self::FAILURE;
        }

        $isDryRun = $this->option('dry-run');

        if ($isDryRun) {
            $this->info('Running in DRY-RUN mode — no changes will be saved.');
        }

        // Load all rank levels ordered by level ascending
        $rankLevels = collect(config('mlm.ranks.rank_levels', []))
            ->sortBy('level')
            ->values();

        if ($rankLevels->isEmpty()) {
            $this->error('No rank levels defined in config/mlm.php');
            return self::FAILURE;
        }

        // ── Build the member query ────────────────────────────────
        $query = User::where('role', 'user')
            ->with(['rank'])
            ->orderBy('id');

        if ($userId = $this->option('user')) {
            $query->where('id', $userId);
        }

        $total = $query->count();

        $this->info("Checking {$total} member(s) against " . $rankLevels->count() . " rank levels…");
        $this->newLine();

        $bar = $this->output->createProgressBar($total);
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% — %message%');
        $bar->setMessage('Starting…');
        $bar->start();

        // ── Process each member ───────────────────────────────────
        $query->chunk(100, function ($members) use ($rankLevels, $isDryRun, $bar) {
            foreach ($members as $member) {
                $bar->setMessage("Checking {$member->name}");
                $bar->advance();

                $this->processMember($member, $rankLevels, $isDryRun);
            }
        });

        $bar->setMessage('Done.');
        $bar->finish();
        $this->newLine(2);

        // ── Summary ───────────────────────────────────────────────
        $this->table(
            ['Metric', 'Count'],
            [
                ['Members checked',  $this->checked],
                ['Ranks upgraded',   $this->upgraded],
                ['Already at rank',  $this->skipped],
            ]
        );

        if ($isDryRun && $this->upgraded > 0) {
            $this->newLine();
            $this->warn("DRY-RUN: {$this->upgraded} upgrade(s) would have been applied.");
        } elseif ($this->upgraded > 0) {
            $this->newLine();
            $this->info("✓ {$this->upgraded} member(s) upgraded successfully.");
        } else {
            $this->newLine();
            $this->line('No rank changes needed.');
        }

        return self::SUCCESS;
    }

    // ─────────────────────────────────────────────────────────────
    // Process a single member
    // ─────────────────────────────────────────────────────────────
    private function processMember(User $member, $rankLevels, bool $isDryRun): void
    {
        $this->checked++;

        // Compute stats for this member once
        $stats = $this->getMemberStats($member);

        // Find the highest rank the member qualifies for
        $eligibleRank = null;

        foreach ($rankLevels as $rankDef) {
            if ($this->qualifies($stats, $rankDef)) {
                $eligibleRank = $rankDef;
            }
        }

        if (! $eligibleRank) {
            $this->skipped++;
            return;
        }

        $currentLevel = $member->rank?->level ?? -1;
        $eligibleLevel = $eligibleRank['level'];

        // No upgrade needed
        if ($currentLevel >= $eligibleLevel) {
            $this->skipped++;

            if ($this->option('verbose')) {
                $this->line(
                    "  <fg=gray>— {$member->name} (#{$member->id}) already at {$member->rank?->name}</>",
                    null,
                    OutputInterface::VERBOSITY_VERBOSE
                );
            }
            return;
        }

        // ── Upgrade! ──────────────────────────────────────────────
        $oldRankName = $member->rank?->name ?? 'None';
        $newRankName = $eligibleRank['name'];

        if ($this->option('verbose') || $this->option('dry-run')) {
            $prefix = $isDryRun ? '<fg=yellow>[DRY-RUN]</>' : '<fg=green>[UPGRADE]</>';
            $this->newLine();
            $this->line(
                "  {$prefix} {$member->name} (#{$member->id}): {$oldRankName} → {$newRankName}"
            );
        }

        if (! $isDryRun) {
            DB::transaction(function () use ($member, $eligibleRank) {
                // Find or create the Rank model by name
                $rank = Rank::firstOrCreate(
                    ['name' => $eligibleRank['name']],
                    [
                        'name'         => $eligibleRank['name'],
                        'level'        => $eligibleRank['level'],
                        'bonus_amount' => $eligibleRank['bonus_amount'],
                    ]
                );

                $isUpgrade = ($member->rank?->level ?? -1) < $rank->level;

                $member->update(['rank_id' => $rank->id]);

                // Credit rank bonus if this is an upgrade (not a reassignment)
                if ($isUpgrade && $eligibleRank['bonus_amount'] > 0) {
                    $bonusWallet = $member->wallets()->where('type', 'bonus')->first();
                    $bonusWallet?->credit(
                        $eligibleRank['bonus_amount'],
                        'Rank Bonus',
                        "Achieved {$eligibleRank['name']} rank",
                        ['rank_name' => $rank['name']]
                    );
                }
            });
        }

        $this->upgraded++;
    }

    // ─────────────────────────────────────────────────────────────
    // Gather the stats needed to evaluate rank criteria
    // ─────────────────────────────────────────────────────────────
    private function getMemberStats(User $member): array
    {
        // Personal sales = sum of paid/approved commissions sourced from own purchases
        $personalSales = $member->purchases()
            ->whereIn('status', ['paid'])
            ->sum('amount') ?? 0;

        // Team sales = sum of all downline purchases (recursive via sponsor_id chain)
        // Use a simpler approximation: sum of sponsor_id tree via recursive CTE or nested query
        $teamSales = $this->getTeamSales($member->id);

        // Direct referrals = number of users directly sponsored
        $directCount = User::where('sponsor_id', $member->id)->count();

        return [
            'personal_sales' => (float) $personalSales,
            'team_sales'     => (float) $teamSales,
            'direct_count'   => (int)   $directCount,
        ];
    }

    // ─────────────────────────────────────────────────────────────
    // Recursively sum team sales using a CTE (works on MySQL 8+)
    // Falls back to a simple direct-children sum if CTE unavailable
    // ─────────────────────────────────────────────────────────────
    private function getTeamSales(int $userId): float
    {
        try {
            // Recursive CTE — gets all descendant IDs
            $result = DB::select("
                WITH RECURSIVE downline AS (
                    SELECT id FROM users WHERE sponsor_id = ?
                    UNION ALL
                    SELECT u.id FROM users u
                    INNER JOIN downline d ON u.sponsor_id = d.id
                )
                SELECT COALESCE(SUM(p.amount), 0) AS total
                FROM purchases p
                INNER JOIN downline dl ON p.user_id = dl.id
                WHERE p.status IN ('paid')
            ", [$userId]);

            return (float) ($result[0]->total ?? 0);
        } catch (\Throwable) {
            // Fallback: direct children only
            $children = User::where('sponsor_id', $userId)->pluck('id');
            if ($children->isEmpty()) return 0;

            return (float) DB::table('purchases')
                ->whereIn('user_id', $children)
                ->whereIn('status', ['paid'])
                ->sum('amount');
        }
    }

    // ─────────────────────────────────────────────────────────────
    // Check if a member's stats meet a rank definition's criteria
    // ─────────────────────────────────────────────────────────────
    private function qualifies(array $stats, array $rankDef): bool
    {
        return $stats['personal_sales'] >= ($rankDef['minimum_sales']       ?? 0)
            && $stats['team_sales']     >= ($rankDef['minimum_team_sales']  ?? 0)
            && $stats['direct_count']   >= ($rankDef['minimum_directs']     ?? 0);
    }
}

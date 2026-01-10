<?php

namespace App\Services;

use App\Models\User;
use App\Models\Commission;

class CommissionService
{
    /**
     * Award direct referral commission
     */
    public function awardDirectReferralCommission(User $newUser, float $amount): ?Commission
    {
        if (!$newUser->sponsor) {
            return null;
        }

        $config = config('mlm.commission.direct_referral');
        
        if (!$config['enabled']) {
            return null;
        }

        $commissionAmount = $config['type'] === 'percentage' 
            ? ($amount * $config['rate'] / 100)
            : $config['rate'];

        return $this->createCommission(
            $newUser->sponsor,
            $newUser,
            'direct',
            $commissionAmount,
            1,
            'Direct referral commission'
        );
    }

    /**
     * Award unilevel commissions
     */
    public function awardUnilevelCommissions(User $user, float $amount): array
    {
        $commissions = [];
        $config = config('mlm.commission.unilevel');

        if (!$config['enabled']) {
            return $commissions;
        }

        $sponsor = $user->sponsor;
        $level = 1;

        while ($sponsor && isset($config['levels'][$level])) {
            $rate = $config['levels'][$level];
            $commissionAmount = $amount * $rate / 100;

            $commission = $this->createCommission(
                $sponsor,
                $user,
                'unilevel',
                $commissionAmount,
                $level,
                "Level {$level} unilevel commission"
            );

            if ($commission) {
                $commissions[] = $commission;
            }

            $sponsor = $sponsor->sponsor;
            $level++;
        }

        return $commissions;
    }

    /**
     * Award rank bonus
     */
    public function awardRankBonus(User $user): ?Commission
    {
        if (!$user->rank || $user->rank->bonus_amount <= 0) {
            return null;
        }

        return $this->createCommission(
            $user,
            $user,
            'rank_bonus',
            $user->rank->bonus_amount,
            $user->rank->level,
            "Rank achievement bonus: {$user->rank->name}"
        );
    }

    /**
     * Create a commission record and credit to wallet
     */
    protected function createCommission(
        User $recipient,
        User $fromUser,
        string $type,
        float $amount,
        int $level = 1,
        ?string $description = null
    ): Commission
    {
        // Create commission record
        $commission = Commission::create([
            'user_id' => $recipient->id,
            'from_user_id' => $fromUser->id,
            'type' => $type,
            'amount' => $amount,
            'level' => $level,
            'description' => $description,
            'status' => 'approved', // Auto-approve for now
            'approved_at' => now(),
        ]);

        // Credit to commission wallet
        $wallet = $recipient->wallets()->where('type', 'commission')->first();
        if ($wallet) {
            $wallet->credit(
                $amount,
                'commission',
                $description,
                ['commission_id' => $commission->id]
            );
        }

        return $commission;
    }

    /**
     * Get total network count for a user
     */
    public function getTotalNetworkCount(User $user): int
    {
        $count = $user->downlines()->count();
        
        foreach ($user->downlines as $downline) {
            $count += $this->getTotalNetworkCount($downline);
        }
        
        return $count;
    }

    /**
     * Get total team sales for a user
     */
    public function getTotalTeamSales(User $user): float
    {
        // This would need to be implemented based on your sales tracking
        // For now, returning 0
        return 0;
    }

    /**
     * Check if user qualifies for rank upgrade
     */
    public function checkRankEligibility(User $user): ?int
    {
        $directReferrals = $user->downlines()->count();
        $personalSales = 0; // Implement based on your sales tracking
        $teamSales = $this->getTotalTeamSales($user);

        $eligibleRank = null;

        foreach (config('mlm.ranks.rank_levels') as $rankConfig) {
            if (
                $personalSales >= $rankConfig['minimum_sales'] &&
                $teamSales >= $rankConfig['minimum_team_sales'] &&
                $directReferrals >= $rankConfig['minimum_directs']
            ) {
                $eligibleRank = \App\Models\Rank::where('slug', $rankConfig['slug'])->first()?->id;
            }
        }

        return $eligibleRank;
    }
}

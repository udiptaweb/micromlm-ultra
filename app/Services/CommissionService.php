<?php

namespace App\Services;

use App\Models\User;
use App\Models\Commission;
use App\Models\Purchase;
use App\Models\Wallet;

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
     * Create a commission record
     */
    public function createCommission(
        User $recipient,
        User $fromUser,
        string $type,
        float $amount,
        int $level = 1,
        ?string $description = null,
        ?string $status = 'pending'
    ): Commission {
        // Create commission record
        $commission = Commission::create([
            'user_id' => $recipient->id,
            'from_user_id' => $fromUser->id,
            'type' => $type,
            'amount' => $amount,
            'level' => $level,
            'description' => $description,
            'status' => $status,
            'approved_at' => $status == 'approved' ? now() : null,
        ]);

        if ($status == 'approved') {
            $wallet = Wallet::where('user_id', $recipient->id)->where('type', 'commission')->first();
            if ($wallet) {
                $wallet->credit($amount, 'direct_sales_commission', $commission->description, ['commission_id' => $commission->id]);
            }
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


    //binary start
    /**
     * Calculate and award binary commission for a user
     * This should be called from a scheduled command (cron)
     */
    public function calculateBinaryCommission(
        User $user,
        float $leftAvailableBV,
        float $rightAvailableBV
    ): ?Commission {
        $config = config('mlm.commission.binary');

        if (!($config['enabled'] ?? false)) {
            return null;
        }

        // Calculate total pairs
        $totalPairs = min($leftAvailableBV, $rightAvailableBV);

        if ($totalPairs <= 0) {
            return null;
        }

        $pairAmount = $config['pair_amount'];
        $grossAmount = $totalPairs * $pairAmount;

        // Apply capping
        $netAmount = $this->applyBinaryCapping($user, $grossAmount);

        if ($netAmount <= 0) {
            return null;
        }

        $paidPairs = floor($netAmount / $pairAmount);

        // Create binary commission
        $commission = $this->createCommission(
            $user,
            $user,
            'binary',
            $netAmount,
            1,
            "Binary commission ({$paidPairs} pairs)"
        );

        // Award matching bonus to uplines
        $this->awardBinaryMatchingBonus($user, $netAmount);

        return $commission;
    }

    /**
     * Apply binary capping limits
     */
    protected function applyBinaryCapping(User $user, float $amount): float
    {
        $config = config('mlm.commission.binary.capping');

        if (!($config['enabled'] ?? false)) {
            return $amount;
        }

        $todayTotal = Commission::where('user_id', $user->id)
            ->where('type', 'binary')
            ->whereDate('created_at', today())
            ->sum('amount');

        $remaining = ($config['daily_limit'] ?? PHP_INT_MAX) - $todayTotal;

        return max(0, min($amount, $remaining));
    }

    /**
     * Award matching bonus for binary income
     */
    protected function awardBinaryMatchingBonus(User $earner, float $binaryAmount): void
    {
        $config = config('mlm.commission.binary.matching_bonus');

        if (!($config['enabled'] ?? false)) {
            return;
        }

        $upline = $earner->sponsor;
        $level = 1;

        while ($upline && isset($config['levels'][$level])) {
            $rate = $config['levels'][$level];
            $amount = $binaryAmount * $rate / 100;

            if ($amount > 0) {
                $this->createCommission(
                    $upline,
                    $earner,
                    'matching',
                    $amount,
                    $level,
                    "Binary matching bonus (Level {$level})"
                );
            }

            $upline = $upline->sponsor;
            $level++;
        }
    }

    /**
     * Calculate carry-forward BV after binary payout
     */
    public function calculateBinaryCarryForward(
        float $leftAvailableBV,
        float $rightAvailableBV,
        int $paidPairs
    ): array {
        return [
            'left_carry'  => max(0, $leftAvailableBV - $paidPairs),
            'right_carry' => max(0, $rightAvailableBV - $paidPairs),
        ];
    }

    public function fromPurchase(Purchase $purchase): void
    {
        foreach ($purchase->items as $item) {

            if (!$item->product->commission_enabled) {
                continue;
            }

            $amount = ($item->price * $item->qty)
                * ($item->product->commission_percent / 100);
            if ($purchase->user->sponsor_id) {
                $this->createCommission($purchase->user->sponsor, $purchase->user, 'direct', $amount, '1', 'Product purchase commission', 'approved');
            }
        }
    }
}

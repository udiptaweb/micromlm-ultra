<?php

namespace App\Services;

use App\Models\User;
use App\Services\CommissionService;

/**
 * Example Usage of CommissionService
 * 
 * This file demonstrates how to use the CommissionService
 * to award commissions in your MLM system.
 */

class CommissionExamples
{
    protected CommissionService $commissionService;

    public function __construct(CommissionService $commissionService)
    {
        $this->commissionService = $commissionService;
    }

    /**
     * Example 1: Award commission when a new user registers
     */
    public function onUserRegistration(User $newUser, float $packageAmount = 100)
    {
        // Award direct referral commission to sponsor
        $this->commissionService->awardDirectReferralCommission($newUser, $packageAmount);

        // Award unilevel commissions to upline
        $this->commissionService->awardUnilevelCommissions($newUser, $packageAmount);
    }

    /**
     * Example 2: Award commission when a user makes a purchase
     */
    public function onPurchase(User $user, float $purchaseAmount)
    {
        // Award unilevel commissions to upline
        $this->commissionService->awardUnilevelCommissions($user, $purchaseAmount);
    }

    /**
     * Example 3: Check and upgrade user rank
     */
    public function checkAndUpgradeRank(User $user)
    {
        $eligibleRankId = $this->commissionService->checkRankEligibility($user);

        if ($eligibleRankId && $eligibleRankId != $user->rank_id) {
            // Update user rank
            $user->update(['rank_id' => $eligibleRankId]);

            // Award rank achievement bonus
            $this->commissionService->awardRankBonus($user);

            return true;
        }

        return false;
    }

    /**
     * Example 4: Manual commission award
     */
    public function awardManualBonus(User $user, float $amount, string $reason)
    {
        $wallet = $user->wallets()->where('type', 'bonus')->first();
        
        if ($wallet) {
            $wallet->credit($amount, 'bonus', $reason);
        }
    }

    /**
     * Example 5: Get user's network statistics
     */
    public function getUserNetworkStats(User $user)
    {
        return [
            'direct_referrals' => $user->downlines()->count(),
            'total_network' => $this->commissionService->getTotalNetworkCount($user),
            'total_commissions' => $user->commissions()->sum('amount'),
            'pending_commissions' => $user->commissions()->pending()->sum('amount'),
            'paid_commissions' => $user->commissions()->paid()->sum('amount'),
            'current_rank' => $user->rank?->name ?? 'Member',
        ];
    }
}

/**
 * Usage in your controllers or event listeners:
 * 
 * // In a controller
 * public function purchase(Request $request, CommissionService $commissionService)
 * {
 *     $user = auth()->user();
 *     $amount = $request->input('amount');
 *     
 *     // Process purchase...
 *     
 *     // Award commissions
 *     $commissionService->awardUnilevelCommissions($user, $amount);
 * }
 * 
 * // In an event listener
 * class UserRegisteredListener
 * {
 *     public function handle(Registered $event)
 *     {
 *         $commissionService = app(CommissionService::class);
 *         $commissionService->awardDirectReferralCommission($event->user, 100);
 *     }
 * }
 * 
 * // Using Livewire
 * public function processPayment()
 * {
 *     $commissionService = app(\App\Services\CommissionService::class);
 *     $commissionService->awardUnilevelCommissions(auth()->user(), $this->amount);
 * }
 */

<?php

namespace App\Listeners;

use App\Services\CommissionService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Container\Attributes\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log as FacadesLog;

class UserRegisteredListener
{
    protected CommissionService $commissionService;
    public function __construct(CommissionService $commissionService)
    {
        $this->commissionService = $commissionService;
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        FacadesLog::info('UserRegisteredListener triggered for user ID: ' . $event->user->id);
        $newUser = $event->user;
        $packageAmount = 100; // Default package amount for new registrations

        // Award direct referral commission to sponsor
        $this->commissionService->awardDirectReferralCommission($newUser, $packageAmount);

    }
}

<?php

namespace App\Listeners;

use App\Events\PurchasePaid;
use App\Services\CommissionService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DistributePurchaseCommission
{
    /**
     * Create the event listener.
     */
    protected CommissionService $commissionService;

    public function __construct(CommissionService $commissionService)
    {
        $this->commissionService = $commissionService;
    }

    /**
     * Handle the event.
     */
    public function handle(PurchasePaid $event): void
    {
        $this->commissionService->fromPurchase($event->purchase);
    }
}

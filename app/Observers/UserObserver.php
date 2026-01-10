<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Create user profile
        $user->profile()->create([]);

        // Create main wallet
        $user->wallets()->create([
            'type' => 'main',
            'balance' => 0,
            'pending_balance' => 0,
        ]);

        // Create commission wallet
        $user->wallets()->create([
            'type' => 'commission',
            'balance' => 0,
            'pending_balance' => 0,
        ]);

        // Create bonus wallet
        $user->wallets()->create([
            'type' => 'bonus',
            'balance' => 0,
            'pending_balance' => 0,
        ]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}

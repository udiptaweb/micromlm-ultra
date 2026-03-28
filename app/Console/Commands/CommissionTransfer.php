<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CommissionTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commission:transfer-to-main {--user=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer commission wallet balance to main wallet';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->option('user');

        $users = User::query()
            ->when($userId, fn($q) => $q->where('id', $userId))
            ->with(['commissionWallet', 'mainWallet'])
            ->where('role','user')
            ->get();

        $count = 0;

        foreach ($users as $user) {

            $commissionWallet = $user->commissionWallet;
            $mainWallet = $user->mainWallet;

            if (!$commissionWallet || !$mainWallet) {
                continue;
            }

            $amount = $commissionWallet->balance;

            if ($amount <= 0) {
                continue;
            }

            DB::transaction(function () use ($commissionWallet, $mainWallet, $amount) {

                // Debit commission wallet
                $commissionWallet->debit($amount, 'transfer', 'Commission swept to main wallet');

                // Credit main wallet
                $mainWallet->credit($amount, 'transfer', 'Commission received from commission wallet');
            });

            $count++;
            $this->info("Transferred ₹{$amount} for User ID {$user->id}");
        }

        $this->info("✅ Transfer completed for {$count} user(s).");

        return self::SUCCESS;
    }
}

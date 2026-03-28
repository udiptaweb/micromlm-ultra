<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\BinaryVolume;
use App\Services\CommissionService;
use Illuminate\Support\Facades\DB;

class CalculateBinaryCommission extends Command
{
    protected $signature = 'binary:calculate';

    protected $description = 'Calculate and distribute binary commissions';

    public function handle(CommissionService $commissionService): int
    {
        $this->info('Binary commission calculation started...');

        User::whereHas('binaryVolumes')->chunk(100, function ($users) use ($commissionService) {
            foreach ($users as $user) {
                DB::transaction(function () use ($user, $commissionService) {

                    $leftBV = BinaryVolume::where('user_id', $user->id)
                        ->where('side', 'left')
                        ->lockForUpdate()
                        ->first();

                    $rightBV = BinaryVolume::where('user_id', $user->id)
                        ->where('side', 'right')
                        ->lockForUpdate()
                        ->first();

                    $leftAvailable = $leftBV?->volume ?? 0;
                    $rightAvailable = $rightBV?->volume ?? 0;

                    if ($leftAvailable <= 0 || $rightAvailable <= 0) {
                        return;
                    }

                    // Pay binary commission
                    $commission = $commissionService->calculateBinaryCommission(
                        $user,
                        $leftAvailable,
                        $rightAvailable
                    );

                    if (!$commission) {
                        return;
                    }

                    $pairAmount = config('mlm.commission.binary.pair_amount');
                    $paidPairs = floor($commission->amount / $pairAmount);

                    // Deduct used BV (carry forward logic)
                    $leftBV->decrement('volume', $paidPairs);
                    $rightBV->decrement('volume', $paidPairs);
                });
            }
        });

        $this->info('Binary commission calculation completed.');

        return self::SUCCESS;
    }
}

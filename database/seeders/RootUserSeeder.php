<?php

namespace Database\Seeders;

use App\Models\Rank;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RootUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultRank = Rank::where('level', 0)->first();

        $user = User::firstOrCreate(['email' => 'root@micromlm.com'],
[
            'name' => 'Root User',
            'username' => 'root',
            'email' => 'root@micromlm.com',
            'password' => Hash::make('password'),
            'referral_code' => 'MEMBR001',
            'rank_id' => $defaultRank->id,
            'status' => 'active',
            'email_verified_at' => now(),
            'role' => 'user',
        ]);

        // Create user profile
        $user->profile()->firstOrCreate(['user_id' => $user->id],[]);

        // Create main wallet
        $user->wallets()->firstOrCreate(['type' => 'main','user_id' => $user->id],[
            'type' => 'main',
            'balance' => 0,
            'pending_balance' => 0,
        ]);

        // Create commission wallet
        $user->wallets()->firstOrCreate(['type' => 'commission','user_id' => $user->id],[
            'type' => 'commission',
            'balance' => 0,
            'pending_balance' => 0,
        ]);

        // Create bonus wallet
        $user->wallets()->firstOrCreate(['type' => 'bonus','user_id' => $user->id],[
            'type' => 'bonus',
            'balance' => 0,
            'pending_balance' => 0,
        ]);
    }
}

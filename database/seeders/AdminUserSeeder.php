<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultRank = Rank::where('level', 0)->first();

        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@micromlm.com',
            'password' => Hash::make('password'),
            'referral_code' => 'ADMIN001',
            'rank_id' => $defaultRank->id,
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
    }
}

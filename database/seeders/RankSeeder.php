<?php

namespace Database\Seeders;

use App\Models\Rank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranks = config('mlm.ranks.rank_levels');

        foreach ($ranks as $rank) {
            Rank::create([
                'name' => $rank['name'],
                'slug' => $rank['slug'],
                'level' => $rank['level'],
                'minimum_sales' => $rank['minimum_sales'],
                'minimum_team_sales' => $rank['minimum_team_sales'],
                'minimum_directs' => $rank['minimum_directs'],
                'bonus_amount' => $rank['bonus_amount'],
                'badge_color' => $this->getBadgeColor($rank['slug']),
                'is_active' => true,
            ]);
        }
    }

    private function getBadgeColor(string $slug): string
    {
        return match($slug) {
            'member' => '#718096',
            'bronze' => '#CD7F32',
            'silver' => '#C0C0C0',
            'gold' => '#FFD700',
            'platinum' => '#E5E4E2',
            'diamond' => '#B9F2FF',
            default => '#000000',
        };
    }
}

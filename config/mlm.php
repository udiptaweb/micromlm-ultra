<?php

return [
    /*
    |--------------------------------------------------------------------------
    | MLM System Configuration
    |--------------------------------------------------------------------------
    |
    | Configure your MLM system settings including commission rates,
    | genealogy structure, and business rules.
    |
    */

    'genealogy' => [
        'type' => 'binary', // binary, unilevel, matrix
        'spillover' => true, // Allow spillover placement
    ],

    'commission' => [
        'direct_referral' => [
            'enabled' => true,
            'rate' => 10, // Percentage or fixed amount
            'type' => 'percentage', // percentage or fixed
        ],

        'binary' => [
            'enabled' => true,
            'pair_amount' => 100, // Amount earned per pair
            'capping' => [
                'enabled' => true,
                'daily_limit' => 1000,
                'weekly_limit' => 5000,
                'monthly_limit' => 20000,
            ],
            'matching_bonus' => [
                'enabled' => true,
                'levels' => [
                    1 => 10, // 10% of downline binary commission
                    2 => 5,
                    3 => 3,
                ],
            ],
        ],
        'matrix' => [
            'enabled' => false,
            'width' => 3,   // Max direct referrals
            'depth' => 5,   // Commission levels
            'levels' => [
                1 => 10,
                2 => 8,
                3 => 6,
                4 => 4,
                5 => 2,
            ],
        ],


        'unilevel' => [
            'enabled' => false,
            'levels' => [
                1 => 8,  // 8% on level 1
                2 => 5,  // 5% on level 2
                3 => 3,  // 3% on level 3
                4 => 2,
                5 => 2,
                6 => 1,
                7 => 1,
            ],
        ],

        'generation' => [
            'enabled' => false,
            'generations' => 5,
            'rate' => 5, // Percentage per generation
        ],
    ],

    'ranks' => [
        'auto_rank_upgrade' => true,
        'check_interval' => 'daily', // daily, weekly, monthly
        'rank_levels' => [
            [
                'name' => 'Member',
                'slug' => 'member',
                'level' => 0,
                'minimum_sales' => 0,
                'minimum_team_sales' => 0,
                'minimum_directs' => 0,
                'bonus_amount' => 0,
            ],
            [
                'name' => 'Bronze',
                'slug' => 'bronze',
                'level' => 1,
                'minimum_sales' => 1000,
                'minimum_team_sales' => 5000,
                'minimum_directs' => 3,
                'bonus_amount' => 100,
            ],
            [
                'name' => 'Silver',
                'slug' => 'silver',
                'level' => 2,
                'minimum_sales' => 5000,
                'minimum_team_sales' => 25000,
                'minimum_directs' => 5,
                'bonus_amount' => 500,
            ],
            [
                'name' => 'Gold',
                'slug' => 'gold',
                'level' => 3,
                'minimum_sales' => 10000,
                'minimum_team_sales' => 100000,
                'minimum_directs' => 10,
                'bonus_amount' => 2000,
            ],
            [
                'name' => 'Platinum',
                'slug' => 'platinum',
                'level' => 4,
                'minimum_sales' => 25000,
                'minimum_team_sales' => 500000,
                'minimum_directs' => 20,
                'bonus_amount' => 10000,
            ],
            [
                'name' => 'Diamond',
                'slug' => 'diamond',
                'level' => 5,
                'minimum_sales' => 50000,
                'minimum_team_sales' => 1000000,
                'minimum_directs' => 50,
                'bonus_amount' => 50000,
            ],
        ],
    ],

    'wallet' => [
        'default_types' => ['main', 'commission', 'bonus'],
        'minimum_withdrawal' => 50,
        'withdrawal_fee' => 2, // Percentage
        'withdrawal_processing_days' => 7,
    ],

    'registration' => [
        'require_sponsor' => true,
        'default_sponsor_username' => 'admin',
        'auto_placement' => true,
        'placement_preference' => 'left', // left, right, balanced
        'email_verification_required' => true,
    ],

    'security' => [
        'max_login_attempts' => 5,
        'lockout_duration' => 30, // minutes
        'session_timeout' => 60, // minutes
        'require_2fa' => false,
    ],

    'payout' => [
        'schedule' => 'weekly', // daily, weekly, biweekly, monthly
        'payout_day' => 'friday', // For weekly
        'minimum_balance' => 50,
        'auto_payout' => false,
    ],
];

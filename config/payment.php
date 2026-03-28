<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Available Payment Methods
    |--------------------------------------------------------------------------
    |
    | Used across purchases, validation, UI, and business logic
    |
    */

    'methods' => [
        'wallet' => [
            'label' => 'Wallet Balance',
            'enabled' => true,
        ],

        'e_pin' => [
            'label' => 'E-Pin',
            'enabled' => true,
        ],

        'crypto' => [
            'label' => 'Crypto Payment',
            'enabled' => true,
        ],

        'gateway' => [
            'label' => 'Payment Gateway',
            'enabled' => true,
        ],

        'cash' => [
            'label' => 'Cash / Admin Credit',
            'enabled' => true,
        ],
    ],
];

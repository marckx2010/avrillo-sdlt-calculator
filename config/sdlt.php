<?php

return [
    'standard' => [
        ['limit' => 250000, 'rate' => 0],
        ['limit' => 925000, 'rate' => 0.05],
        ['limit' => 1500000, 'rate' => 0.10],
        ['limit' => null, 'rate' => 0.12],
    ],

    'first_time' => [
        'max_price' => 625000,
        'bands' => [
            ['limit' => 425000, 'rate' => 0],
            ['limit' => 625000, 'rate' => 0.05],
        ],
    ],

    'surcharge' => 0.03,
];

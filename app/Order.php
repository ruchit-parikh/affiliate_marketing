<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * Staus that are allowed for package 
     */
    public static $status = [
        'completed' => [
            'code' => 1,
            'display' => [
                'en' => 'Completed'
            ]
        ], 
        'discarded' => [
            'code' => 0,
            'display' => [
                'en' => 'Discarded'
            ]
        ], 
        'pending' => [
            'code' => 2,
            'display' => [
                'en' => 'Pending'
            ]
        ],
    ];

    /**
     * Payment Methods 
     */
    public static $payment_type = [
        'paypal' => [
            'slug' => 'paypal',
            'display' => [
                'en' => 'Paypal'
            ],
        ],
        'cash' => [
            'slug' => 'cash',
            'display' => [
                'en' => 'Cash'
            ],
        ],
    ];

    /**
     * Order types
     */
    public static $order_type = [
        'register' => [
            'slug' => 'register', 
            'display' => [
                'en' => 'Registered on it\'s own.'
            ]
        ], 
        'admin_added' => [
            'slug' => 'admin_added',
            'display' => [
                'en' => 'Added by admin.'
            ]
        ],
        'user_added' => [
            'slug' => 'user_added',
            'display' => [
                'en' => 'Added by user.'
            ]
        ], 
        'user_upgraded' => [
            'slug' => 'upgraded', 
            'display' => [
                'en' => 'Upgraded By Owner.'
            ]
        ],
        'admin_upgraded' => [
            'slug' => 'admin_upgraded', 
            'display' => [
                'en' => 'Upgraded By Admin.'
            ]
        ]
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    
    protected $guarded = [
        'id',
    ];

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

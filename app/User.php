<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $status = [
        'active' => [
            'code' => 1,
            'display' => [
                'en' => 'Active',
            ],
        ], 
        'inactive' => [
            'code' => 0,
            'display' => [
                'en' => 'Inactive',
            ],
        ], 
        'pending' => [
            'code' => 2, 
            'display' => [
                'en' => 'Pending',
            ],
        ],
    ];

    public static $default_role = 'customer';

    /**
     * Payout types are which through user will get their payments
     */
    public static $payouts = [
        [
            'key' => 'paypal',
            'display' => [
                'en' => 'Paypal'
            ]
        ], 
        [
            'key' => 'bank_wire', 
            'display' => [
                'en' => 'Bank Wire'
            ]
        ]
    ];

    public function setPasswordAttribute($password)
    {
        if ( !empty($password) ) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function role()
    {
        $this->belongsTo(Role::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

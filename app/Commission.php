<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commission extends Model
{
    use SoftDeletes;
    
    protected $guarded = [
        'id',
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
    ];

    public function scopeActive($commissions)
    {
        $commissions->where('status', self::$status['active']['code']);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}

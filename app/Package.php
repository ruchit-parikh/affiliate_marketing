<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;
    
    protected $guarded = [
        'id',
    ];

    public static $allowed_default_children = 1;

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

    public function commissionTypes()
    {
        return $this->hasMany(Commission::class);
    }

    public function scopeActive($packages)
    {
        $packages->where('status', self::$status['active']['code']);
    }

    public static function boot ()
    {
        parent::boot();
        self::deleting(function (Package $package) {
            foreach ($package->commissionTypes as $commission_type) {
                $commission_type->delete();
            }
        });
    }
}

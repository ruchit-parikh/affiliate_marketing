<?php

namespace App\Http\Controllers\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\PackageCollection;
use App\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::active()->with(['commissionTypes' => function($commissions) {
            $commissions->active();
        }])->paginate(config('pagination.per_page'));
        return new PackageCollection($packages);
    }
}

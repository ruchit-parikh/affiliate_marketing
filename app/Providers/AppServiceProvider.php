<?php

namespace App\Providers;

use App\Commission;
use App\Observers\CommissionObserver;
use App\Observers\PackageObserver;
use App\Package;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
        Schema::defaultStringLength(191);
        Carbon::setLocale('LC_TIME', app()->getLocale());
        $this->__registerObservers();
    }

    private function __registerObservers()
    {
        Package::observe(PackageObserver::class);
        Commission::observe(CommissionObserver::class);
    }
}

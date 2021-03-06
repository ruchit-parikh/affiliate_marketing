<?php

namespace App\Observers;

use App\Log;
use App\Package;

class PackageObserver
{
    public function created(Package $package)
    {
        Log::create([
            'slug' => 'package-created',
            'logged_by' => auth()->check() ? auth()->user()->id : null,
            'message' => __('packages.store.log', [
                'user' => auth()->check() ? auth()->user()->name : __('users.types.guest'), 
                'package_name' => $package->name
            ]), 
            'payload' => null
        ]);
    }

    public function updated(Package $package)
    {
        Log::create([
            'slug' => 'package-updated',
            'logged_by' => auth()->check() ? auth()->user()->id : null,
            'message' => __('packages.update.log', [
                'user' => auth()->check() ? auth()->user()->name : __('users.types.guest'), 
                'package_name' => $package->name
            ]), 
            'payload' => null
        ]);
    }

    public function deleted(Package $package)
    {
        Log::create([
            'slug' => 'package-deleted',
            'logged_by' => auth()->check() ? auth()->user()->id : null,
            'message' => __('packages.destroy.log', [
                'user' => auth()->check() ? auth()->user()->name : __('users.types.guest'), 
                'package_name' => $package->name
            ]), 
            'payload' => null
        ]);
    }

    public function restored(Package $package)
    {
        Log::create([
            'slug' => 'package-restored',
            'logged_by' => auth()->check() ? auth()->user()->id : null,
            'message' => __('packages.restored.log', [
                'user' => auth()->check() ? auth()->user()->name : __('users.types.guest'), 
                'package_name' => $package->name
            ]), 
            'payload' => null
        ]);
    }

    public function forceDeleted(Package $package)
    {
        Log::create([
            'slug' => 'package-delete-permanently',
            'logged_by' => auth()->check() ? auth()->user()->id : null,
            'message' => __('packages.force_delete.log', [
                'user' => auth()->check() ? auth()->user()->name : __('users.types.guest'), 
                'package_name' => $package->name
            ]), 
            'payload' => null
        ]);
    }
}

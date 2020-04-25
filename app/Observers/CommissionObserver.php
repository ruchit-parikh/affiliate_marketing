<?php

namespace App\Observers;

use App\Commission;
use App\Log;

class CommissionObserver
{
    public function created(Commission $commission)
    {
        Log::create([
            'slug' => 'commission-created',
            'logged_by' => auth()->check() ? auth()->user()->id : null,
            'message' => __('commissions.store.log', [
                'user' => auth()->check() ? auth()->user()->name : __('users.types.guest'), 
                'commission_name' => $commission->type
            ]), 
            'payload' => null
        ]);
    }

    public function updated(Commission $commission)
    {
        Log::create([
            'slug' => 'commission-updated',
            'logged_by' => auth()->check() ? auth()->user()->id : null,
            'message' => __('commissions.update.log', [
                'user' => auth()->check() ? auth()->user()->name : __('users.types.guest'), 
                'commission_name' => $commission->type
            ]), 
            'payload' => null
        ]);
    }

    public function deleted(Commission $commission)
    {
        Log::create([
            'slug' => 'commission-deleted',
            'logged_by' => auth()->check() ? auth()->user()->id : null,
            'message' => __('commissions.destroy.log', [
                'user' => auth()->check() ? auth()->user()->name : __('users.types.guest'), 
                'commission_name' => $commission->type
            ]), 
            'payload' => null
        ]);
    }

    public function restored(Commission $commission)
    {
        Log::create([
            'slug' => 'commission-restored',
            'logged_by' => auth()->check() ? auth()->user()->id : null,
            'message' => __('commissions.restored.log', [
                'user' => auth()->check() ? auth()->user()->name : __('users.types.guest'), 
                'commission_name' => $commission->type
            ]), 
            'payload' => null
        ]);
    }

    public function forceDeleted(Commission $commission)
    {
        Log::create([
            'slug' => 'commission-delete-permanently',
            'logged_by' => auth()->check() ? auth()->user()->id : null,
            'message' => __('commissions.force_delete.log', [
                'user' => auth()->check() ? auth()->user()->name : __('users.types.guest'), 
                'commission_name' => $commission->type
            ]), 
            'payload' => null
        ]);
    }
}

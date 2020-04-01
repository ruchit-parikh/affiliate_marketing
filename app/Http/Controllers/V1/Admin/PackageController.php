<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        try {
            $package->delete();
            return jsonResponse('success', __('packages.destroy.success'));
        } catch(\Exception $e) {
            return jsonResponse('error', __('packages.destroy.failed'));
        }
    }
}

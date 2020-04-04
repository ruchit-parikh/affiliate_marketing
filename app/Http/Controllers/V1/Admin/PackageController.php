<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PackageCollection;
use App\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::paginate(config('pagination.per_page'));
        return new PackageCollection($packages);
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
            return json_response('success', __('packages.destroy.success'));
        } catch(\Exception $e) {
            return json_response('error', __('packages.destroy.failed'));
        }
    }
}

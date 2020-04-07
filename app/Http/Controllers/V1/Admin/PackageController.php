<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PackageCollection;
use App\Package;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('commissionTypes')->paginate(config('pagination.per_page'));
        return new PackageCollection($packages);
    }

    public function store(Request $request)
    {
        $this->__validate($request);

        try {
            $package = Package::create($request->only(
                'name', 'description', 'amount', 'allowed_children', 'status'
            ));
            return json_response('success', __('packages.store.success'));
        } catch (\Exception $e) {
            return json_response('error', __('packages.store.failed')); 
        }
    }

    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);
        $this->__validate($request, $id);

        try {
            $package->update($request->only(
                'name', 'description', 'amount', 'allowed_children', 'status'
            ));
            return json_response('success', __('packages.update.success'));
        } catch (\Exception $e) {
            return json_response('error', __('packages.update.failed')); 
        }
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

    /**
     * Validate request before storing or updating data
     * 
     * @param Request $request
     * @param int | boolean $is_update = false
     * @return void | 422 JSON
     */
    private function __validate(Request $request, $is_update = false) 
    {
        $rules = [
            'name' => 'required|max:255',
            'description' => 'required',
            'amount' => 'required|numeric|min:0',
            'allowed_children' => 'required|integer|min:1',
            'status' => ['required', Rule::in(array_column(Package::$status, 'code'))]
        ];
        return $this->validate($request, $rules);
    }
}

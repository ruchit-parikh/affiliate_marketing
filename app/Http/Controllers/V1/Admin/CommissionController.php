<?php

namespace App\Http\Controllers\V1\Admin;

use App\Commission;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommissionCollection;
use App\Package;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommissionController extends Controller
{
    public function index()
    {
        $commissions = Commission::with('package')->paginate(config('pagination.per_page'));
        return new CommissionCollection($commissions);
    }

    public function store(Request $request)
    {
        $this->__validate($request);

        try {
            $commission = Commission::create($request->only(
                'type', 'percentage_amount', 'level', 'package_id', 'status'
            ));
            return json_response('success', __('commissions.store.success'));
        } catch (\Exception $e) {
            return json_response('error', __('commissions.store.failed')); 
        }
    }

    public function update(Request $request, $id)
    {
        $commission = Commission::findOrFail($id);
        $this->__validate($request, $id);

        try {
            $commission->update($request->only(
                'type', 'percentage_amount', 'level', 'package_id', 'status'
            ));
            return json_response('success', __('commissions.update.success'));
        } catch (\Exception $e) {
            return json_response('error', __('commissions.update.failed')); 
        }
    }

    public function destroy($id)
    {
        $commission = Commission::findOrFail($id);
        try {
            $commission->delete();
            return json_response('success', __('commissions.destroy.success'));
        } catch(\Exception $e) {
            return json_response('error', __('commissions.destroy.failed'));
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
        $unique_rule = 'unique:commissions,type';
        if ($is_update) {
            $unique_rule = 'unique:commissions,type,'.$is_update;
        }
        $rules = [
            'type' => 'required|max:255|'.$unique_rule,
            'percentage_amount' => 'required|min:0|max:100|numeric',
            'level' => 'required|integer|min:1',
            'package_id' => ['required', Rule::in(Package::active()->pluck('id'))],
            'status' => ['required', Rule::in(array_column(Commission::$status, 'code'))]
        ];
        return $this->validate($request, $rules);
    }
}

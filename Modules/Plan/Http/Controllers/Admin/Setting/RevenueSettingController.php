<?php

namespace Modules\Plan\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\RevenueSetting;
use App\Models\Settings\Units\Type;
use App\Models\Settings\Units\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class RevenueSettingController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('revenueSetting_access');
        $revenueSetting = RevenueSetting::first();
        $unitTypes = Type::all();
        $units = Unit::all();

        return view('revenue::admin.setting.index', compact('revenueSetting', 'unitTypes', 'units'));
    }

    public function store(Request $request)
    {
        $this->checkAuthorization('revenueSetting_create');
        $data = $request->validate([
            'land_measurement_id' => ['nullable', Rule::exists('types', 'id')->withoutTrashed()],
            'land_measurement_standard_id' => ['nullable', Rule::exists('units', 'id')->withoutTrashed()],
        ]);

        RevenueSetting::updateOrCreate([
            'id' => 1,
        ], $data);

        Cache::forget('revenue_setting');

        toast('सेटिंग अद्यावधिक गरियो', 'success');

        return redirect(route('admin.revenue.setting.index'));
    }
}

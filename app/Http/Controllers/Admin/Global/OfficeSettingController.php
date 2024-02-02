<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Models\OfficeHeader;
use App\Models\Settings\FiscalYear;
use App\Models\Settings\OfficeSetting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class OfficeSettingController extends Controller
{
    public function index(): Factory|View|Application
    {
        $this->checkAuthorization('officeSetting_access');
        $officeSetting = OfficeSetting::first();
        $fiscalYears = FiscalYear::get();
        $officeHeaders = OfficeHeader::orderBy('position')->get();

        return view('admin.global.officeSetting.index', compact('officeSetting', 'officeHeaders', 'fiscalYears'));
    }

    public function update(Request $request, OfficeSetting $officeSetting)
    {
        $this->checkAuthorization('officeSetting_edit');
        $validationData = $request->validate(
            [
            'name' => ['required', 'string'],
            'site_address' => ['nullable', 'string'],
            'logo' => ['nullable', 'mimes:png,jpg,jpeg,gif'],
            'logo1' => ['nullable', 'mimes:png,jpg,jpeg,gif'],
            'logo2' => ['nullable', 'mimes:png,jpg,jpeg,gif'],
            'background_image' => ['nullable', 'mimes:png,jpg,jpeg'],
            'google_map' => ['nullable'],
            'province_id' => ['nullable', Rule::exists('provinces', 'id')->withoutTrashed()],
            'district_id' => ['nullable', Rule::exists('districts', 'id')->withoutTrashed()],
            'local_body_id' => ['nullable', Rule::exists('local_bodies', 'id')->withoutTrashed()],
            'fiscal_year_id' => ['nullable', Rule::exists('fiscal_years', 'id')->withoutTrashed()],
            'ward_no' => ['nullable'],
            'phone' => ['nullable'],
            'introduction' => ['nullable'],
            'email' => ['nullable'],
            'website' => ['nullable', 'url'],
            'facebook_link' => ['nullable', 'url'],
        ],
            [
            'name.required' => 'नाम अनिवार्य छ|',
        ]
        );

        if ($request->hasFile('logo') && $officeSetting->logo) {
            $this->deleteFile($officeSetting->logo);
        }
        if ($request->hasFile('logo1') && $officeSetting->logo1) {
            $this->deleteFile($officeSetting->logo1);
        }
        if ($request->hasFile('logo2') && $officeSetting->logo2) {
            $this->deleteFile($officeSetting->logo2);
        }
        if ($request->hasFile('background_image') && $officeSetting->background_image) {
            $this->deleteFile($officeSetting->background_image);
        }
        $officeSetting->update($validationData);

        Cache::forget('office_setting');

        toast('कार्यालय सेटिङ सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }
}

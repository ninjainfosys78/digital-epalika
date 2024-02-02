<?php

namespace Modules\Identity\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Identity\Entities\MinuteTemplateSetting;

class MinuteTemplateSettingController extends Controller
{
    public function index()
    {
        $minuteTemplateSetting = minuteTemplateSettingData();
        return view(
            'identity::admin.setting.minuteSetting.index',
            compact('minuteTemplateSetting')
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'is_hospital_detail_required' => ['nullable', 'boolean'],
            'description' => ['required'],
        ]);

        $minuteTemplateSetting = minuteTemplateSettingData();

        if ($minuteTemplateSetting) {
            $minuteTemplateSetting->update($data);
        } else {
            MinuteTemplateSetting::create($data);
        }
        Cache::forget('minuteTemplateSetting');
        toast('टेम्पलेट सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function updateStatus(MinuteTemplateSetting $minuteTemplateSetting)
    {
        $minuteTemplateSetting->update([
            'status' => !$minuteTemplateSetting->status
        ]);

        Cache::forget('minuteTemplateSetting');

        toast('टेम्पलेट सफलतापूर्वक थपियो', 'success');
        return back();
    }

}

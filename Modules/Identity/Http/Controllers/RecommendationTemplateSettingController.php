<?php

namespace Modules\Identity\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Identity\Entities\RecommendationTemplateSetting;

class RecommendationTemplateSettingController extends Controller
{
    public function index()
    {
        $recommendationTemplateSetting = recommendationTemplateSettingData();
        return view(
            'identity::admin.setting.recommendationSetting.index',
            compact('recommendationTemplateSetting')
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'is_hospital_detail_required' => ['nullable', 'boolean'],
            'description' => ['required'],
        ]);

        $recommendationTemplateSetting = recommendationTemplateSettingData();

        if ($recommendationTemplateSetting) {
            $recommendationTemplateSetting->update($data);
        } else {
            RecommendationTemplateSetting::create($data);
        }
        Cache::forget('recommendationTemplateSetting');
        toast('टेम्पलेट सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function updateStatus(RecommendationTemplateSetting $recommendationTemplateSetting)
    {
        $recommendationTemplateSetting->update([
            'status' => !$recommendationTemplateSetting->status
        ]);

        Cache::forget('recommendationTemplateSetting');

        toast('टेम्पलेट सफलतापूर्वक थपियो', 'success');
        return back();
    }

}

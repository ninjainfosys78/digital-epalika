<?php

namespace Modules\Recommendation\Http\Controllers;

use App\Models\Settings\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Recommendation\Entities\RecommendationSetting;

class RecommendationSettingController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('recommendationSetting_access');
        $employees = Employee::all();
        $recommendationSetting = RecommendationSetting::where('ward_no', auth()->user()->ward_no)->first() ?? RecommendationSetting::findOrFail(1);
        return view('recommendation::admin.setting.employee', compact('employees', 'recommendationSetting'));
    }


    public function update(Request $request, RecommendationSetting $recommendationSetting)
    {
        $this->checkAuthorization('recommendationSetting_edit');
        $data = $request->validate([
            'ward_chairman_id' => ['required'],
            'ward_secretary_id' => ['required']
        ]);

        $recommendationSetting = RecommendationSetting::where('ward_no', auth()->user()->ward_no)->first();
        if ($recommendationSetting) {
            $recommendationSetting->update($data);
        } else {
            RecommendationSetting::create($data + [
                    'ward_no' => auth()->user()->ward_no,
                    'user_id' => auth()->id()
                ]);
        }

        toast('सेटिङ सफलता पुर्वक सेट गरियो');
        return back();
    }
}

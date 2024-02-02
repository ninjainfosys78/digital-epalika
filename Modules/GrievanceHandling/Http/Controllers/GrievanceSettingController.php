<?php

namespace Modules\GrievanceHandling\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Modules\GrievanceHandling\Entities\GrievanceSetting;

class GrievanceSettingController extends Controller
{
    public function index()
    {
        $grievanceSetting = GrievanceSetting::first();
        $users = User::all();
        return view('grievancehandling::admin.setting.grievanceSetting.index', compact('users', 'grievanceSetting'));
    }

    public function update(Request $request, GrievanceSetting $grievanceSetting)
    {
        $data = $request->validate([
            'user_id' => ['required', Rule::exists('users', 'id')->withoutTrashed()],
            'escalation_days' => ['required', 'integer']
        ]);
        $grievanceSetting->update($data);

        toast('सेटिङ सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }
}

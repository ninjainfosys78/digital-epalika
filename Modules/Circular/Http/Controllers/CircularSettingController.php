<?php

namespace Modules\Circular\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Circular\Entities\CircularSetting;

class CircularSettingController extends Controller
{
    public function index()
    {
        $circularSetting = CircularSetting::first();
        return view('circular::admin.setting.index', compact('circularSetting'));
    }

    public function update(Request $request, CircularSetting $circularSetting)
    {
        $data = $request->validate([
            'registration_prefix' => ['nullable', 'string', 'max:255'],
            'dispatch_prefix' => ['nullable', 'string', 'max:255'],
            'registration_number' => ['nullable', 'integer'],
            'dispatch_number' => ['nullable', 'integer'],
            'send_email' => ['nullable','boolean']
        ]);
        $circularSetting->update($data);
        toast(' सेटिङ सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }
}

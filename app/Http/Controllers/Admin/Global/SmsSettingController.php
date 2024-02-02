<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Traits\EnvirinmentTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SmsSettingController extends Controller
{
    use EnvirinmentTrait;

    public function updateAakashSmsConfig(Request $request): RedirectResponse
    {
        $this->checkAuthorization('sms_access');

        $request->validate([
            'AAKASH_SMS_KEY' => ['required'],
        ]);

        $types = ['AAKASH_SMS_KEY'];

        foreach ($types as $key => $type) {
            $this->overWriteEnvFile($type, $request->input($type));
        }

        toast('विशेष गरी सफलतापूर्वक अद्यावधिक गर्नुहोस्', 'success');
        return back();
    }

    public function updateSamayaSmsConfig(Request $request): RedirectResponse
    {
        $this->checkAuthorization('sms_access');

        $request->validate([
            'SAMAYA_SMS_KEY' => ['required'],
            'SAMAYA_SMS_ID' => ['required'],
        ]);

        $types = ['SAMAYA_SMS_KEY', 'SAMAYA_SMS_ID',];

        foreach ($types as $key => $type) {
            $this->overWriteEnvFile($type, $request->input($type));
        }

        toast('विशेष अपडेट सफलतापूर्वक', 'success');
        return back();
    }

    public function smsSetting(): Factory|View|Application
    {
        $this->checkAuthorization('sms_access');

        return view('admin.global.sms.index');
    }
}

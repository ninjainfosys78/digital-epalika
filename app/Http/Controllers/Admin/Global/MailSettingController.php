<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Traits\EnvirinmentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailSettingController extends Controller
{
    use EnvirinmentTrait;

    public function mailSetting()
    {
        $this->checkAuthorization('mail_access');

        return view('admin.global.mail.index');
    }

    public function updateMailSetting(Request $request)
    {
        $this->checkAuthorization('mail_access');

        $request->validate([
            'MAIL_MAILER' => ['required'],
            'MAIL_HOST' => ['required'],
            'MAIL_PORT' => ['required'],
            'MAIL_USERNAME' => ['required'],
            'MAIL_PASSWORD' => ['required'],
            'MAIL_ENCRYPTION' => ['required'],
            'MAIL_FROM_ADDRESS' => ['required'],
            'MAIL_FROM_NAME' => ['required'],
        ]);

        $types = ['MAIL_MAILER', 'MAIL_HOST', 'MAIL_PORT', 'MAIL_USERNAME', 'MAIL_PASSWORD', 'MAIL_ENCRYPTION', 'MAIL_FROM_ADDRESS', 'MAIL_FROM_NAME',];

        foreach ($types as $key => $type) {
            $this->overWriteEnvFile($type, $request->input($type));
        }

        toast('मेल सफलतापूर्वक अपडेट गरियो', 'success');
        return back();
    }

    public function sendTestMail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        Mail::to($request->input('email'))->send(new TestMail());

        toast('कृपया आफ्नो मेल जाँच गर्नुहोस्', 'success');
        return back();
    }
}

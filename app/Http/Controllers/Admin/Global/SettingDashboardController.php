<?php

namespace App\Http\Controllers\Admin\Global;

use App\Enums\FeatureTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\FeatureActivation;

class SettingDashboardController extends Controller
{
    public function __invoke()
    {
        $email_setup = (bool) FeatureActivation::where('feature_type', FeatureTypeEnum::MAIL)
            ->where('feature_status', 1)
            ->first();
        $sms_setup = (bool) FeatureActivation::where('feature_type', FeatureTypeEnum::SMS)
            ->where('feature_status', 1)
            ->first();
        return view('admin.global.dashboard', compact('email_setup', 'sms_setup'));
    }
}

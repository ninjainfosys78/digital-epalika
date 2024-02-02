<?php

namespace Modules\BusinessRegistration\Http\Controllers;

use App\Traits\NepaliDateConverter;
use App\Http\Controllers\Controller;

class BusinessRegistrationReportController extends Controller
{
    use NepaliDateConverter;

    public function dateWise()
    {
        return view('businessregistration::admin.businessRegistrationReport.index');
    }
}

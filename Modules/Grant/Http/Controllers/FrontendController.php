<?php

namespace Modules\Grant\Http\Controllers;

use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        return view('grant::frontend.index');
    }

    public function applicationRegistration()
    {
        return view('grant::frontend.application_registration');
    }
}

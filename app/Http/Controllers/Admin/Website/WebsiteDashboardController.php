<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;

class WebsiteDashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.website.dashboard');
    }
}

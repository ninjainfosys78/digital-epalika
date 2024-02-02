<?php

namespace App\Http\Controllers\Installer;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('installer.index');
    }
}

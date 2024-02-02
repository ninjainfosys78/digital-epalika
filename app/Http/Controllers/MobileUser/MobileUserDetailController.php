<?php

namespace App\Http\Controllers\MobileUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\MobileUser\StoreMobileUserRequest;
use App\Http\Requests\MobileUserDetail\StoreMobileDetailUserRequest;
use App\Models\MobileUserDetail;
use Illuminate\Http\Request;

class MobileUserDetailController extends Controller
{

    public function index() {
        return view('mobileUser.mobileUserDetail');
    }

    public function store(StoreMobileDetailUserRequest $request)
    {
        MobileUserDetail::create($request->validated());
        return redirect(route('digital-service'));
    }

}

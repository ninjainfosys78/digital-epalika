<?php

namespace App\Http\Controllers\MobileUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\MobileUser\StoreMobileUserRequest;
use App\Http\Requests\MobileUser\UpdatePasswordRequest;
use App\Http\Requests\MobileUser\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\MobileUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MobileUserAuthController extends Controller
{


    public function showMobileUserRegisterForm()
    {
        return view('mobileUser.auth.register');
    }


    public function signup(StoreMobileUserRequest $request)
    {

        MobileUser::create($request->validated());

        toast('सफलतापुर्बक सेवाग्राही रेजिस्टर हुनु भयो !!', 'success');

        return redirect(route('digital-service'));
    }



    public function mobileUserLogin(Request $request): RedirectResponse|string
    {
        if (config('app.env') === 'production') {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
                'g-recaptcha-response' => ['recaptcha'],
            ], ['g-recaptcha-response.recaptcha' => 'Please verify captcha']);
        } else {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);
        }

        if (Auth::guard('mobile-user')->attempt(['email' => $request->email, 'password' => $request->password, 'is_active' => 1], $request->get('remember'))) {
            return redirect()->route('digital-service');
        }

        return back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('mobile-user')->logout();

        return redirect('/');
    }

    public function updateProfile(UpdateProfileRequest $request, MobileUser $mobileUser)
    {
        $request->user('mobile-user')->update($request->validated());
        toast('प्रोफाइल सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect()->route('digital-service');
    }

    public function editProfile()
    {
        $mobileUser = Auth::guard('mobile-user')->user();
        return view('mobileUser.auth.updateProfile', compact('mobileUser'));
    }

    public function editPassword()
    {
        $mobileUser = Auth::guard('mobile-user')->user();
        return view('mobileUser.auth.updatePassword', compact('mobileUser'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:7',
        ]);
        $user = Auth::guard('mobile-user')->user();
        if (!Hash::check($request->current_password, $user->password)) {
            toast('Incorrect current password', 'error');
            return back();
        }
        $user->update([
            'password' => ($request->password),
        ]);
        toast('पासवर्ड सफलतापूर्वक परिवर्तन गरियो', 'success');
        return redirect()->route('digital-service');
    }
}

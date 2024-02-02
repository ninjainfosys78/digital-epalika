<?php

namespace App\Http\Controllers;

use App\Events\ActivityLogEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;

class LoginController extends Controller
{
    //    public function __construct()
    //    {
    //        parent::__construct();
    //
    //        $this->middleware('guest')->except([
    //            'locked',
    //            'unlock',
    //        ]);
    //    }

    public function locked()
    {
        if (!session('lock-expires-at')) {
            return redirect('/');
        }

        if (session('lock-expires-at') > now()) {
            return redirect('/');
        }

        return view('admin.lock_screen.lock_screen');
    }

    public function unlock(Request $request)
    {
        $check = Hash::check($request->input('password'), $request->user()->password);

        if (!$check) {
            return redirect()->route('login.locked')->withErrors([
                'Your password does not match your profile.',
            ]);
        }
        $redirectTo = session()->exists('route_to_redirect') ? session('route_to_redirect') : route('admin.dashboard');

        session()->forget('route_to_redirect');

        session(['lock-expires-at' => now()->addMinutes($request->user()->getLockoutTime())]);

        return redirect($redirectTo);
    }

    public function login(Request $request): RedirectResponse
    {
        $data = [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
        if (App::environment('production')) {
            $credentials = $request->validate(array_merge($data, [
                'g-recaptcha-response' => ['required']
            ]));
        } else {
            $credentials = $request->validate($data);
        }
        if (Auth::attempt(\Arr::except($credentials, 'g-recaptcha-response'))) {
            $request->session()->regenerate();

            event(new ActivityLogEvent('Login'));
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    public function logout(Request $request): RedirectResponse
    {
        session()->flush();
        Auth::guard('web')->logout();
        return redirect(route('login'));
    }

    public function loginPage()
    {
        return view('auth.login');
    }
}

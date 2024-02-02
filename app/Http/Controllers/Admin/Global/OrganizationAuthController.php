<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\EMap\Entities\Organization;
use Modules\EMap\Http\Requests\StorePasswordRequest;

class OrganizationAuthController extends Controller
{
    public function showOrganizationLoginForm()
    {
        return view('admin.global.organization.auth.login');
    }

    public function organizationLogin(Request $request): RedirectResponse
    {
        if (config('app.env') === 'production') {
            $request->validate(
                [
                'email' => 'required|email',
                'password' => 'required|min:6',
                // 'g-recaptcha-response' => ['recaptcha'],
            ],
                // ['g-recaptcha-response.recaptcha' => 'Please verify captcha']
            );
        } else {
            $request->validate(
                [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]
            );
        }

        if (Auth::guard('organization')->attempt(['email' => $request->email, 'password' => $request->password, 'is_active' => 1], $request->get('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }


        return back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('organization')->logout();

        return redirect('/');
    }

    public function showOrganizationRegisterForm()
    {
        return view('admin.global.organization.auth.register');
    }

    public function showOrganizationRegisterFormPerson()
    {
        return view('admin.global.auth.register_person');
    }

    public function invitation(Organization $organization)
    {
        if (!request()->hasValidSignature() || $organization->password) {
            abort(401);
        }

        auth('organization')->login($organization);

        return redirect()->route('dashboard');
    }

    public function create()
    {
        if (auth('organization')->user()->password) {
            return redirect()->route('dashboard');
        }

        return view('admin.global.organization.auth.password');
    }

    public function store(StorePasswordRequest $request)
    {
        $redirect = redirect()->route('dashboard');
        $user = auth('organization')->user();

        if (!$user?->password) {
            $user?->update([
                'password' => $request->input('password'),
            ]);

            toast('पासवर्ड सफलतापुर्वक राखियो', 'success');
        }

        return $redirect;
    }

    public function profile()
    {
        $organization = \auth('organization')->user();

        return view('admin.global.organization.profile', compact('organization'));
    }
}

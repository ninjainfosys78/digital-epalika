<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Resources\Api\Mobile\ProfileResource;
use App\Models\MobileUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:mobile_users,email'],
            'phone' => ['required'],
            'password' => ['required', 'min:7'],
        ]);

        // Create a new user
        $user = MobileUser::create($validated);

        return response()->json(['user' => $user, 'message' => 'User registered successfully'], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:7']
        ]);

        $superAdmin = MobileUser::where('email', $request->input('email'))->first();
        if ($superAdmin && Hash::check($request->input('password'), $superAdmin->password)) {
            $superAdmin->update(['is_active' => 1]);
            Auth::guard('mobile-user')->setUser($superAdmin);
            $authToken = auth('mobile-user')->user()->createToken('auth-token')->plainTextToken;

            return response()->json([
                'message' => "Signed In Successfully",
                'auth_token' => $authToken,
            ]);
        } else {
            return response()->json([
                'message' => "Invalid Credentials",
                'errors' => [
                    'password' => [
                        'Invalid Credentials'
                    ]
                ]
            ], 422);
        }
    }

    public function logout(Request $request)
    {
        $superAdmin = MobileUser::where('email', $request->input('email'))->first();
        if ($superAdmin && Hash::check($request->input('password'), $superAdmin->password)) {
            Auth::guard('mobile-user')->setUser($superAdmin);
            $request = auth('mobile-user')->user()->currentAccessToken()->delete();
            return response()->json([
                'data' => "",
                'message' => "Logged Out Successfully"
            ]);
        } else {
            return response()->json([
                'message' => "Invalid Credentials",
                'errors' => [
                    'password' => [
                        'Invalid Credentials'
                    ]
                ]
            ], 422);
        }


    }

    public function profile()
    {
        return response()->json([
            'user' => ProfileResource::make(auth()->user())
        ]);
    }
}

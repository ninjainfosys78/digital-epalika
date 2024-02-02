<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePinRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PinController extends Controller
{
    public function create()
    {
        return view('admin.pin');
    }
    public function store(StorePinRequest $request)
    {
        if (empty(auth()->user()->pin)) {
            auth()->user()->update([
                'pin' => $request->input('pin')
            ]);
            toast('पिन सफलतापूर्वक थपियो', 'success');
            return  redirect(route('admin.dashboard'));
        }
    }

    public function checkPin(Request $request)
    {
        $request->validate([
            'pin' => ['required','integer']
        ]);
        return response()->json([
            'status' => Hash::check($request->input('pin'), auth()->user()->pin)
        ]);
    }
}

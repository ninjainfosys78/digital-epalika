<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Models\MobileUser;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MobileUserController extends Controller
{
    public function index()
    {

        $mobileUsers = MobileUser::latest()->get();

        return view('admin.global.mobileUser.index', compact('mobileUsers'));
    }

    public function updateLoginStatus(MobileUser $mobileUser)
    {
        DB::transaction(function () use ($mobileUser) {
            $mobileUser->update([
                'is_active' => !$mobileUser->is_active,
            ]);
        });
        toast('सेवाग्राहीलाइ लाग-इन गर्न दिने', 'success');
        return back();
    }

    public function show(MobileUser $mobileUser)
    {
        return view('admin.global.mobileUser.show', compact('mobileUser'));
    }

    public function destroy(MobileUser $mobileUser)
    {
        $mobileUser->delete();
        toast(' सेवाग्राही सफलतापूर्वक मेटाइयो', 'success');

        return back();
    }
}

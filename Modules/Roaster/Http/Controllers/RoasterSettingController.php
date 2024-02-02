<?php

namespace Modules\Roaster\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Roaster\Entities\RoasterSetting;

class RoasterSettingController extends Controller
{
    public function index()
    {
        $roasterSetting = RoasterSetting::first() ?? null;
        return view('roaster::admin.setting.roasterSetting.index', compact('roasterSetting'));
    }

    public function create()
    {
        return view('roaster::create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'is_verified' => ['required']
        ]);
        $roasterSetting = RoasterSetting::first() ?? null;

        if (!empty($roasterSetting)) {
            $roasterSetting->update($data);
        } else {
            RoasterSetting::create($data);
        }
        toast('Setting set successfully', 'success');
        return back();
    }

    public function show($id)
    {
        return view('roaster::show');
    }

    public function edit($id)
    {
        return view('roaster::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

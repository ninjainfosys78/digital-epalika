<?php

namespace Modules\ExecutiveMeeting\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\ExecutiveMeeting\Entities\MinuteSetting;

class MinuteSettingController extends Controller
{
    public function index()
    {
        $minuteSetting = MinuteSetting::first() ?? null;
        return view('executivemeeting::admin.setting.minuteSetting.index', compact('minuteSetting'));
    }

    public function create()
    {
        return view('executivemeeting::create');
    }

    public function store(Request $request)
    {
        $minuteSetting = MinuteSetting::first() ?? null;
        $request->validate([
            'description' => ['required']
        ]);

        if (!empty($minuteSetting)) {
            $minuteSetting->update([
                'description' => $request->input('description')
            ]);
        } else {
            MinuteSetting::create([
                'description' => $request->input('description')
            ]);
        }
        toast('माइन्यूट सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show($id)
    {
        return view('executivemeeting::show');
    }

    public function edit($id)
    {
        return view('executivemeeting::edit');
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

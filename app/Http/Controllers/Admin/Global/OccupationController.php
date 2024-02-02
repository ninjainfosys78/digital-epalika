<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Requests\Occupation\StoreOccupationRequest;
use App\Http\Requests\Occupation\UpdateOccupationRequest;
use App\Models\Occupation;
use App\Http\Controllers\Controller;

class OccupationController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('occupation_access');
        $occupations = Occupation::latest()->get();
        return view('admin.global.occupation.index', compact('occupations'));
    }

    public function create()
    {
        $this->checkAuthorization('occupation_create');
        return view('admin.global.occupation.create');
    }

    public function store(StoreOccupationRequest $request)
    {
        $this->checkAuthorization('occupation_create');
        Occupation::create($request->validated());
        toast('पेसा सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(Occupation $occupation)
    {
        $this->checkAuthorization('occupation_access');
    }

    public function edit(Occupation $occupation)
    {
        $this->checkAuthorization('occupation_edit');
        return view('admin.global.occupation.edit', compact('occupation'));
    }

    public function update(UpdateOccupationRequest $request, Occupation $occupation)
    {
        $this->checkAuthorization('occupation_edit');

        $occupation->update($request->validated());
        toast('पेसा सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.global.generalSetting.occupation.index'));
    }

    public function destroy(Occupation $occupation)
    {
        $this->checkAuthorization('occupation_delete');
        $occupation->delete();
        toast('पेसा सफलतापूर्वक मेटियो', 'success');
        return back();
    }
}

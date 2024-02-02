<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Designation\StoreDesignationRequest;
use App\Http\Requests\Setting\Designation\UpdateDesignationRequest;
use App\Models\Settings\Designation;

class DesignationController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('designation_access');
        $designations = Designation::latest()->get();

        return view('admin.global.designation.index', compact('designations'));
    }

    public function create()
    {
        $this->checkAuthorization('designation_create');

        return view('admin.global.designation.create');
    }

    public function store(StoreDesignationRequest $request)
    {
        $this->checkAuthorization('designation_create');
        $designation = Designation::create($request->validated());

        toast('पद सफलतापूर्वक थपियो !', 'success');

        return back();
    }

    public function edit(Designation $designation)
    {
        $this->checkAuthorization('designation_edit');

        return view('admin.global.designation.edit', compact('designation'));
    }

    public function update(UpdateDesignationRequest $request, Designation $designation)
    {
        $this->checkAuthorization('designation_edit');
        $designation->update($request->validated());
        toast('पद सफलतापूर्वक अद्यावधिक गरियो !', 'success');

        return back();
    }

    public function destroy(Designation $designation)
    {
        $this->checkAuthorization('designation_delete');
        $designation->delete();
        toast('पदनाम सफलतापूर्वक मेटियो!', 'success');

        return back();
    }
}

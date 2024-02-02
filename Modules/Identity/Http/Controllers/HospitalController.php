<?php

namespace Modules\Identity\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Identity\Entities\Hospital;
use Modules\Identity\Http\Requests\Hospital\StoreHospitalRequest;
use Modules\Identity\Http\Requests\Hospital\UpdateHospitalRequest;

class HospitalController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('hospital_access');

        $hospitals = Hospital::all();

        return view('identity::admin.setting.hospital.index', compact('hospitals'));
    }

    public function create()
    {
        $this->checkAuthorization('hospital_create');

        return view('identity::admin.setting.hospital.create');
    }

    public function store(StoreHospitalRequest $request)
    {
        $this->checkAuthorization('hospital_create');

        Hospital::create($request->validated());

        toast('अस्पताल सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function edit(Hospital $hospital)
    {
        $this->checkAuthorization('hospital_edit');

        return view('identity::admin.setting.hospital.edit', compact('hospital'));
    }

    public function update(UpdateHospitalRequest $request, Hospital $hospital)
    {
        $this->checkAuthorization('hospital_edit');

        $hospital->update($request->validated());

        toast('अस्पताल सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('identity.admin.setting.hospital.index'));
    }

    public function destroy(Hospital $hospital)
    {
        $this->checkAuthorization('hospital_delete');

        $hospital->delete();

        toast('अस्पताल सफलतापूर्वक हटाइयो', 'success');
        return back();
    }
}

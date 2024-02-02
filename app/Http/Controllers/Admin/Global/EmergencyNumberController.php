<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Requests\Setting\EmergencyNumber\StoreEmergencyNumberRequest;
use App\Http\Requests\Setting\EmergencyNumber\UpdateEmergencyNumberRequest;
use App\Http\Controllers\Controller;
use App\Models\Settings\EmergencyCategory;
use App\Models\Settings\EmergencyNumber;

class EmergencyNumberController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('emergencyNumber_access');

        $EmergencyNumbers = EmergencyNumber::with('emergencyCategory')->get();

        return view('admin.global.emergencyNumber.index', compact('EmergencyNumbers'));
    }

    public function create()
    {
        $this->checkAuthorization('emergencyNumber_create');
        $emergencyCategories = EmergencyCategory::all();
        return view('admin.global.emergencyNumber.create', compact('emergencyCategories'));
    }

    public function store(StoreEmergencyNumberRequest $request)
    {
        $this->checkAuthorization('emergencyNumber_create');
        EmergencyNumber::create($request->validated());

        toast('आपतकालीन नम्बर सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function edit(EmergencyNumber $emergencyNumber)
    {
        $this->checkAuthorization('emergencyNumber_edit');
        $emergencyCategories = EmergencyCategory::all();

        return view('admin.global.emergencyNumber.edit', compact('emergencyNumber', 'emergencyCategories'));
    }

    public function update(UpdateEmergencyNumberRequest $request, EmergencyNumber $emergencyNumber)
    {
        $this->checkAuthorization('emergencyNumber_edit');

        $emergencyNumber->update($request->validated());

        toast('आपतकालीन नम्बर सफलतापूर्वक अपडेट गरियो', 'success');

        return redirect(route('admin.global.generalSetting.emergencyNumber.index'));
    }

    public function destroy(EmergencyNumber $emergencyNumber)
    {
        $this->checkAuthorization('emergencyNumber_delete');
        $emergencyNumber->delete();
        toast('आपतकालीन नम्बर सफलतापूर्वक मेटियो!', 'success');

        return back();
    }
}

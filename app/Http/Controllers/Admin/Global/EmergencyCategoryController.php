<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\EmergencyCategory\StoreEmergencyCategoryRequest;
use App\Http\Requests\Setting\EmergencyCategory\UpdateEmergencyCategoryRequest;
use App\Models\Settings\EmergencyCategory;

class EmergencyCategoryController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('emergencyNumber_access');

        $EmergencyCategories = EmergencyCategory::get();

        return view('admin.global.emergencyCategory.index', compact('EmergencyCategories'));
    }

    public function create()
    {
        return view('admin.global.emergencyCategory.create');
    }


    public function store(StoreEmergencyCategoryRequest $request)
    {
        $this->checkAuthorization('emergencyNumber_create');

        EmergencyCategory::create($request->validated());

        toast('आपतकालीन सेवा सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function edit(EmergencyCategory $emergencyCategory)
    {
        return view('admin.global.emergencyCategory.edit', compact('emergencyCategory'));
    }

    public function update(UpdateEmergencyCategoryRequest $request, EmergencyCategory $emergencyCategory)
    {
        $this->checkAuthorization('emergencyNumber_edit');

        $emergencyCategory->update($request->validated());

        toast('आपतकालीन सेवा सफलतापूर्वक अपडेट गरियो', 'success');

        return redirect(route('admin.global.emergencyCategory.index'));
    }


    public function destroy(EmergencyCategory $emergencyCategory)
    {
        $this->checkAuthorization('emergencyNumber_delete');
        $emergencyCategory->delete();
        toast('आपतकालीन सेवा सफलतापूर्वक मेटियो!', 'success');

        return back();
    }
}

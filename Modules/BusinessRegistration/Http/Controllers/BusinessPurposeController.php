<?php

namespace Modules\BusinessRegistration\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\BusinessRegistration\Entities\BusinessPurpose;
use Modules\BusinessRegistration\Http\Requests\BusinessPurpose\StoreBusinessPurposeRequest;
use Modules\BusinessRegistration\Http\Requests\BusinessPurpose\UpdateBusinessPurposeRequest;

class BusinessPurposeController extends Controller
{
    public function index()
    {
        abort_if(
            Gate::denies('businessPurpose_access'),
            403,
            'You are not allowed to digital board news access'
        );
        $businessPurposes = BusinessPurpose::get();
        return view('businessregistration::admin.setting.businessPurpose.index', compact('businessPurposes'));
    }

    public function create()
    {
        abort_if(
            Gate::denies('businessPurpose_create'),
            403,
            'You are not allowed to digital board news access'
        );
        return view('businessregistration::admin.setting.businessPurpose.create');
    }

    public function store(StoreBusinessPurposeRequest $request)
    {
        abort_if(
            Gate::denies('businessPurpose_create'),
            403,
            'You are not allowed to digital board news access'
        );
        BusinessPurpose::create($request->validated());
        toast(' उदेश्य सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(BusinessPurpose $businessPurpose)
    {
        abort_if(
            Gate::denies('businessPurpose_access'),
            403,
            'You are not allowed to digital board news access'
        );
        return view('businessregistration::show');
    }

    public function edit(BusinessPurpose $businessPurpose)
    {
        abort_if(
            Gate::denies('businessPurpose_edit'),
            403,
            'You are not allowed to digital board news access'
        );
        return view('businessregistration::admin.setting.businessPurpose.edit', compact('businessPurpose'));
    }

    public function update(UpdateBusinessPurposeRequest $request, BusinessPurpose $businessPurpose)
    {
        abort_if(
            Gate::denies('businessPurpose_edit'),
            403,
            'You are not allowed to digital board news access'
        );
        $businessPurpose->update($request->validated());
        toast('उदेश्य सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.businessRegistration.setting.businessPurpose.index'));
    }

    public function destroy(BusinessPurpose $businessPurpose)
    {
        abort_if(
            Gate::denies('businessPurpose_delete'),
            403,
            'You are not allowed to digital board news access'
        );
        $businessPurpose->delete();
        toast(' सफलतापूर्वक मेटियो', 'success');
        return back();
    }
}

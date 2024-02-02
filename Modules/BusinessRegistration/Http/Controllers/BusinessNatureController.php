<?php

namespace Modules\BusinessRegistration\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\BusinessRegistration\Entities\BusinessNature;
use Modules\BusinessRegistration\Http\Requests\BusinessNature\StoreBusinessNature;
use Modules\BusinessRegistration\Http\Requests\BusinessNature\UpdateBusinessNature;

class BusinessNatureController extends Controller
{
    public function index()
    {
        abort_if(
            Gate::denies('businessNature_access'),
            403,
            'You are not allowed to digital board news access'
        );
        $businessNatures = BusinessNature::latest()->get();
        return view('businessregistration::admin.setting.businessNature.index', compact('businessNatures'));
    }

    public function create()
    {
        abort_if(
            Gate::denies('businessNature_create'),
            403,
            'You are not allowed to digital board news access'
        );
        return view('businessregistration::admin.setting.businessNature.create');
    }

    public function store(StoreBusinessNature $request)
    {
        abort_if(
            Gate::denies('businessNature_create'),
            403,
            'You are not allowed to digital board news access'
        );

        BusinessNature::create($request->validated());
        toast(' व्यवसाय प्रकृति सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(BusinessNature $businessNature)
    {
        abort_if(
            Gate::denies('businessNature_access'),
            403,
            'You are not allowed to digital board news access'
        );
        return view('businessregistration::show');
    }

    public function edit(BusinessNature $businessNature)
    {
        abort_if(
            Gate::denies('businessNature_edit'),
            403,
            'You are not allowed to digital board news access'
        );
        return view('businessregistration::admin.setting.businessNature.edit', compact('businessNature'));
    }

    public function update(UpdateBusinessNature $request, BusinessNature $businessNature)
    {
        abort_if(
            Gate::denies('businessNature_edit'),
            403,
            'You are not allowed to digital board news access'
        );

        $businessNature->update($request->validated());
        toast(' व्यवसाय प्रकृति सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.businessRegistration.setting.businessNature.index'));
    }

    public function destroy(BusinessNature $businessNature)
    {
        abort_if(
            Gate::denies('businessNature_delete'),
            403,
            'You are not allowed to digital board news access'
        );

        $businessNature->delete();
        toast(' सफलतापूर्वक मेटियो', 'success');
        return back();
    }
}

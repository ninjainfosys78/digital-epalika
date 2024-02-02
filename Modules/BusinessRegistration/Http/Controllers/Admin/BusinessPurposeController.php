<?php

namespace Modules\BusinessRegistration\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\BusinessRegistration\Entities\BusinessPurpose;
use Modules\BusinessRegistration\Http\Requests\BusinessPurpose\StoreBusinessPurposeRequest;
use Modules\BusinessRegistration\Http\Requests\BusinessPurpose\UpdateBusinessPurposeRequest;
use Illuminate\Database\Eloquent\Builder;

class BusinessPurposeController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('businessPurpose_access');
        $businessPurposes = BusinessPurpose::where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['title'], request('search'));
            }
        })
            ->paginate(10);


        return view('businessregistration::admin.setting.businessPurpose.index', compact('businessPurposes'));
    }

    public function create()
    {
        $this->checkAuthorization('businessPurpose_create');

        return view('businessregistration::admin.setting.businessPurpose.create');
    }

    public function store(StoreBusinessPurposeRequest $request): RedirectResponse
    {
        $this->checkAuthorization('businessPurpose_create');
        BusinessPurpose::create($request->validated());
        toast(' उदेश्य सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function show(BusinessPurpose $businessPurpose)
    {
        $this->checkAuthorization('businessPurpose_access');

        return view('businessregistration::show');
    }

    public function edit(BusinessPurpose $businessPurpose)
    {
        $this->checkAuthorization('businessPurpose_edit');

        return view('businessregistration::admin.setting.businessPurpose.edit', compact('businessPurpose'));
    }

    public function update(UpdateBusinessPurposeRequest $request, BusinessPurpose $businessPurpose)
    {
        $this->checkAuthorization('businessPurpose_edit');
        $businessPurpose->update($request->validated());
        toast('उदेश्य सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.businessRegistration.setting.businessPurpose.index'));
    }

    public function destroy(BusinessPurpose $businessPurpose): RedirectResponse
    {
        $this->checkAuthorization('businessPurpose_delete');
        $businessPurpose->delete();
        toast(' सफलतापूर्वक मेटियो', 'success');

        return back();
    }
}

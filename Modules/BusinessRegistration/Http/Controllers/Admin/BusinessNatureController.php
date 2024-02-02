<?php

namespace Modules\BusinessRegistration\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\BusinessRegistration\Entities\BusinessNature;
use Modules\BusinessRegistration\Http\Requests\BusinessNature\StoreBusinessNature;
use Modules\BusinessRegistration\Http\Requests\BusinessNature\UpdateBusinessNature;
use Illuminate\Database\Eloquent\Builder;

class BusinessNatureController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('businessNature_access');
        $businessNatures = BusinessNature::where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['title'], request('search'));
            }
        })
        ->latest()->paginate(10);

        return view('businessregistration::admin.setting.businessNature.index', compact('businessNatures'));
    }

    public function create()
    {
        $this->checkAuthorization('businessNature_create');

        return view('businessregistration::admin.setting.businessNature.create');
    }

    public function store(StoreBusinessNature $request)
    {
        $this->checkAuthorization('businessNature_create');

        BusinessNature::create($request->validated());
        toast(' व्यवसाय प्रकृति सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function show(BusinessNature $businessNature)
    {
        $this->checkAuthorization('businessNature_access');

        return view('businessregistration::show');
    }

    public function edit(BusinessNature $businessNature)
    {
        $this->checkAuthorization('businessNature_edit');

        return view('businessregistration::admin.setting.businessNature.edit', compact('businessNature'));
    }

    public function update(UpdateBusinessNature $request, BusinessNature $businessNature)
    {
        $this->checkAuthorization('businessNature_edit');

        $businessNature->update($request->validated());
        toast(' व्यवसाय प्रकृति सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.businessRegistration.setting.businessNature.index'));
    }

    public function destroy(BusinessNature $businessNature)
    {
        $this->checkAuthorization('businessNature_delete');

        $businessNature->delete();
        toast(' सफलतापूर्वक मेटियो', 'success');

        return back();
    }
}

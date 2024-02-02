<?php

namespace Modules\BusinessRegistration\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use Modules\BusinessRegistration\Entities\BusinessDetail;
use Modules\BusinessRegistration\Entities\BusinessRenew;
use Modules\BusinessRegistration\Http\Requests\BusinessRenew\StoreBusinessRenewRequest;
use Modules\OrganizationRegistration\Http\Requests\BusinessRenew\UpdateBusinessRenewRequest;

class BusinessRenewController extends Controller
{
    public function index(BusinessDetail $businessDetail)
    {
        $this->checkAuthorization('businessRenew_access');
        $businessRenews = BusinessRenew::with('fiscalYear')->where('business_detail_id', $businessDetail->id)->where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['business_renew_date', 'payment_receipt'], request('search'));
            }
        })->latest()->paginate(15);
        return view('businessregistration::admin.businessRenew.index', compact('businessDetail', 'businessRenews'));
    }

    public function create(BusinessDetail $businessDetail)
    {
        $this->checkAuthorization('businessRenew_create');
        return view('businessregistration::admin.businessRenew.create', compact('businessDetail'));
    }

    public function store(StoreBusinessRenewRequest $request, BusinessDetail $businessDetail)
    {
        $this->checkAuthorization('businessRenew_create');
        $businessDetail->businessRenew()->create($request->validated() + [
                'fiscal_year_id' => officeSetting()->fiscal_year_id,
            ]);
        toast('व्यवसाय नवीकरण सफलतापूर्वक थपियो', 'success');
        return redirect(route('admin.businessRegistration.businessRegistration.businessRenew.index', $businessDetail));
    }

    public function show(BusinessDetail $businessDetail, BusinessRenew $businessRenew)
    {
        return view('businessregistration::admin.businessRenew.show', compact('businessRenew', 'businessDetail'));
    }

    public function edit(BusinessDetail $businessDetail, BusinessRenew $businessRenew)
    {
        $this->checkAuthorization('businessRenew_edit');
        return view('businessregistration::admin.businessRenew.edit', compact('businessDetail', 'businessRenew'));
    }

    public function update(UpdateBusinessRenewRequest $request, BusinessDetail $businessDetail, BusinessRenew $businessRenew)
    {
        $this->checkAuthorization('businessRenew_edit');
        $businessDetail->businessRenew()->update($request->validated());
        toast('व्यवसाय नवीकरण सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.businessRegistration.businessRegistration.businessRenew.index', $businessDetail));
    }

    public function destroy(BusinessDetail $businessDetail, BusinessRenew $businessRenew)
    {
        //
    }
}

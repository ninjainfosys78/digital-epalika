<?php

namespace Modules\BusinessRegistration\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\BusinessRegistration\Entities\InvestmentRevenue;
use Modules\BusinessRegistration\Entities\ObjectTransaction;
use Modules\BusinessRegistration\Http\Requests\InvestmentRevenue\StoreInvestmentRevenueRequest;
use Modules\BusinessRegistration\Http\Requests\InvestmentRevenue\UpdateInvestmentRevenueRequest;
use Illuminate\Database\Eloquent\Builder;

class InvestmentRevenueController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('investmentRevenue_access');
        $investmentRevenues = InvestmentRevenue::with('objectTransaction')->where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['title'], request('search'));
            }
        })->latest()->paginate(10);
        ;

        return view('businessregistration::admin.setting.investment-revenues.index', compact('investmentRevenues'));
    }

    public function create()
    {
        $this->checkAuthorization('investmentRevenue_create');
        $objectTransactions = ObjectTransaction::with('objectTransactions')->whereNull('object_transaction_id')->get();

        return view('businessregistration::admin.setting.investment-revenues.create', compact('objectTransactions'));
    }

    public function store(StoreInvestmentRevenueRequest $request): RedirectResponse
    {
        $this->checkAuthorization('investmentRevenue_create');

        InvestmentRevenue::create($request->validated());

        toast(' पुँजीगत लगानी र राजस्वो  सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function show(InvestmentRevenue $investmentRevenue)
    {
        $this->checkAuthorization('investmentRevenue_access');

        return view('businessregistration::show');
    }

    public function edit(InvestmentRevenue $investmentRevenue)
    {
        $this->checkAuthorization('investmentRevenue_edit');

        $objectTransactions = ObjectTransaction::with('objectTransactions')->whereNull('object_transaction_id')->get();

        return view('businessregistration::admin.setting.investment-revenues.edit', compact('objectTransactions', 'investmentRevenue'));
    }

    public function update(UpdateInvestmentRevenueRequest $request, InvestmentRevenue $investmentRevenue): RedirectResponse
    {
        $this->checkAuthorization('investmentRevenue_edit');

        $investmentRevenue->update($request->validated());

        toast(' पुँजीगत लगानी र राजस्वो  अद्यावधिक गरियो', 'success');

        return back();
    }

    public function destroy(InvestmentRevenue $investmentRevenue): RedirectResponse
    {
        $this->checkAuthorization('investmentRevenue_delete');

        $investmentRevenue->delete();

        toast(' पुँजीगत लगानी र राजस्वो  हटाइयो', 'success');

        return back();
    }
}

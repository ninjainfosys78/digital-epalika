<?php

namespace Modules\Grant\Http\Controllers\Admin;

use Illuminate\Console\Application;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Modules\Grant\Entities\CashGrant;
use Modules\Grant\Entities\HelplessnessType;
use Modules\Grant\Http\Requests\CashGrant\StoreCashGrantRequest;
use Modules\Grant\Http\Requests\CashGrant\UpdateCashGrantRequest;

class CashGrantController extends Controller
{
    public function index()
    {
        $cashGrants = CashGrant::with('helplessnessType')->latest()->get();
        return view('grant::admin.cash_grant.index', compact('cashGrants'));
    }

    public function create()
    {
        $helplessnesstypes = HelplessnessType::all();
        return view('grant::admin.cash_grant.create', compact('helplessnesstypes'));
    }

    public function store(StoreCashGrantRequest $request)
    {
        CashGrant::create($request->validated());
        toast('नगद अनुदन सफलता पुर्वक थपियो', 'success');
        return back();
    }

    public function show($id)
    {
        return view('grant::show');
    }

    public function edit(CashGrant $cashGrant)
    {
        $helplessnesstypes = HelplessnessType::all();
        return view('grant::admin.cash_grant.edit', compact('cashGrant', 'helplessnesstypes'));
    }

    public function update(UpdateCashGrantRequest $request, CashGrant$cashGrant): Redirector|Application|RedirectResponse
    {
        $cashGrant->update($request->validated());
        toast('नगद अनुदन सफलता पुर्वक सम्पादन गरियो', 'success');
        return redirect(route('admin.grant.cashGrant.index'));
    }

    public function destroy(CashGrant $cashGrant): RedirectResponse
    {
        $cashGrant->delete();
        toast('नगद अनुदन सफलता पुर्वक हटाइयो', 'success');
        return back();
    }
}

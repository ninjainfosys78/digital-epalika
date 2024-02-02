<?php

namespace Modules\BusinessRegistration\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\BusinessRegistration\Entities\ObjectTransaction;
use Modules\BusinessRegistration\Http\Requests\ObjectTransaction\StoreObjectTransactionRequest;
use Modules\BusinessRegistration\Http\Requests\ObjectTransaction\UpdateObjectTransactionRequest;

class ObjectTransactionController extends Controller
{
    public function index()
    {
        $objectTransactions = ObjectTransaction::get();
        return view('businessregistration::admin.setting.objectTransaction.index', compact('objectTransactions'));
    }

    public function create()
    {
        return view('businessregistration::admin.setting.objectTransaction.create');
    }

    public function store(StoreObjectTransactionRequest $request)
    {
        ObjectTransaction::create($request->validated());
        toast(' कारोबार गर्ने वस्तु  सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    public function show($id)
    {
        return view('businessregistration::show');
    }

    public function edit(ObjectTransaction $objectTransaction)
    {
        return view('businessregistration::admin.setting.objectTransaction.edit', compact('objectTransaction'));
    }

    public function update(UpdateObjectTransactionRequest $request, ObjectTransaction $objectTransaction)
    {
        $objectTransaction->update($request->validated());
        toast('  सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.businessRegistration.setting.objectTransaction.index'));
    }

    public function destroy(ObjectTransaction $objectTransaction)
    {
        $objectTransaction->delete();
        return back();
    }
}

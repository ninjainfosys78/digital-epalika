<?php

namespace Modules\BusinessRegistration\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\BusinessRegistration\Entities\ObjectTransaction;
use Modules\BusinessRegistration\Http\Requests\ObjectTransaction\StoreObjectTransactionRequest;
use Modules\BusinessRegistration\Http\Requests\ObjectTransaction\UpdateObjectTransactionRequest;
use Illuminate\Database\Eloquent\Builder;

class ObjectTransactionController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('objectTransaction_access');

        $objectTransactions = ObjectTransaction::with('objectTransaction')->where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['title','objectTransaction.title'], request('search'));
            }
        })
        ->latest()->paginate(10);

        return view('businessregistration::admin.setting.objectTransaction.index', compact('objectTransactions'));
    }

    public function create()
    {
        $this->checkAuthorization('objectTransaction_create');

        $parentObjectTransactions = ObjectTransaction::whereNull('object_transaction_id')->get();

        return view('businessregistration::admin.setting.objectTransaction.create', compact('parentObjectTransactions'));
    }

    public function store(StoreObjectTransactionRequest $request)
    {
        $this->checkAuthorization('objectTransaction_create');

        ObjectTransaction::create($request->validated());

        toast(' कारोबार गर्ने वस्तु  सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function show($id)
    {
        $this->checkAuthorization('objectTransaction_access');

        return view('businessregistration::show');
    }

    public function edit(ObjectTransaction $objectTransaction)
    {
        $this->checkAuthorization('objectTransaction_edit');

        $parentObjectTransactions = ObjectTransaction::whereNull('object_transaction_id')->get();

        return view('businessregistration::admin.setting.objectTransaction.edit', compact('objectTransaction', 'parentObjectTransactions'));
    }

    public function update(UpdateObjectTransactionRequest $request, ObjectTransaction $objectTransaction)
    {
        $this->checkAuthorization('objectTransaction_edit');
        $objectTransaction->update($request->validated());
        toast('  सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.businessRegistration.setting.objectTransaction.index'));
    }

    public function destroy(ObjectTransaction $objectTransaction)
    {
        $this->checkAuthorization('objectTransaction_delete');
        $objectTransaction->delete();

        return back();
    }
}

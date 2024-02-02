<?php

namespace Modules\Circular\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings\OfficeSetting;
use Modules\Circular\Entities\Dispatch;
use Modules\Circular\Http\Requests\Dispatch\StoreDispatchRequest;
use Modules\Circular\Http\Requests\Dispatch\UpdateDispatchRequest;
use Illuminate\Database\Eloquent\Builder;
use Modules\Circular\Traits\DispatchTrait;

class DispatchController extends Controller
{
    use DispatchTrait;

    public function index()
    {
        $this->checkAuthorization('dispatch_access');

        $dispatches = Dispatch::where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['dispatch_no', 'receiver_name', 'subject'], request('search'));
            }
        })
            ->latest()->paginate(10);


        return view('circular::admin.dispatch.index', compact('dispatches'));
    }

    public function create()
    {
        $this->checkAuthorization('dispatch_create');
        $dispatch_no = $this->getDispatchNumber();

        return view('circular::admin.dispatch.create', compact('dispatch_no'));
    }

    public function store(StoreDispatchRequest $request)
    {
        $this->checkAuthorization('dispatch_create');

        $dispatch = Dispatch::create($request->validated() + [
                'fiscal_year_id' => OfficeSetting::first()->fiscal_year_id,
                'prefix' => $this->getDispatchPrefix(),
                'dispatch_no' => $this->getDispatchNo()
            ]);


        toast('चलानी सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function show(Dispatch $dispatch)
    {
        $this->checkAuthorization('dispatch_access');

        $dispatch->load('fiscalYear', 'dispatchDetail.files');

        return view('circular::admin.dispatch.show', compact('dispatch'));
    }

    public function edit(Dispatch $dispatch)
    {
        $this->checkAuthorization('dispatch_edit');

        return view('circular::admin.dispatch.edit', compact('dispatch'));
    }

    public function update(UpdateDispatchRequest $request, Dispatch $dispatch)
    {
        $this->checkAuthorization('dispatch_edit');

        $dispatch->update($request->validated());

        toast('चलानी सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.circular.dispatch.index'));
    }

    public function destroy(Dispatch $dispatch)
    {
        $this->checkAuthorization('dispatch_delete');

        $dispatch->delete();

        toast('चलानी सफलतापूर्वक मेटियो', 'success');

        return back();
    }

    public function print(Dispatch $dispatch)
    {
        $dispatch->load('dispatchDetail');
        $data = str_replace('[@letterHead]', letterHead(), $dispatch->remarks);
        return view('circular::admin.dispatch.print', compact('data', 'dispatch'));
    }

    public function report(Dispatch $dispatch)
    {
        $dispatch->load('dispatchDetail');
        return view('circular::admin.dispatch.report', compact('dispatch'));
    }
}

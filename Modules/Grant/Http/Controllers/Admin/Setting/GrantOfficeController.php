<?php

namespace Modules\Grant\Http\Controllers\Admin\Setting;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Redirector;
use Modules\Grant\Entities\GrantOffice;
use Modules\Grant\Http\Requests\Setting\GrantOffice\StoreGrantOfficeRequest;
use Modules\Grant\Http\Requests\Setting\GrantOffice\UpdateGrantOfficeRequest;

class GrantOfficeController extends Controller
{
    public function index(): Factory|View|Application
    {
        $this->checkAuthorization('grantOffice_access');

        $offices = GrantOffice::where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['office_name'], request('search'));
            }
        })
            ->latest()->paginate(10);
        return view('grant::admin.setting.grantOffice.index', compact('offices'));
    }

    public function create(): Factory|View|Application
    {
        $this->checkAuthorization('grantOffice_create');
        return view('grant::admin.setting.grantOffice.create');
    }

    public function store(StoreGrantOfficeRequest $request)
    {
        $this->checkAuthorization('grantOffice_create');

        $grantOffice = GrantOffice::create($request->validated());

        if ($request->ajax()) {
            return response()->json([
                'data' => [
                    'grantOffice_id' => $grantOffice->id,
                    'grantOffice_name' => $grantOffice->office_name
                ],
                'message' => 'अनुदान कार्यालय सफलतापूर्वक थपियो'
            ]);
        }

        toast('अनुदान कार्यालय सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show($id)
    {
        return view('grant::show');
    }

    public function edit(GrantOffice $grantOffice)
    {
        $this->checkAuthorization('grantOffice_edit');
        return view('grant::admin.setting.grantOffice.edit', compact('grantOffice'));
    }

    public function update(UpdateGrantOfficeRequest $request, GrantOffice $grantOffice): Redirector|Application|RedirectResponse
    {
        $this->checkAuthorization('grantOffice_edit');

        $grantOffice->update($request->validated());

        toast('अनुदान कार्यालय सफलतापूर्वक सम्पादन गरियो', 'success');
        return redirect(route('admin.grant.setting.grantOffice.index'));
    }

    public function destroy(GrantOffice $grantOffice): RedirectResponse
    {
        $this->checkAuthorization('grantOffice_delete');

        $grantOffice->delete();
        toast('अनुदान कार्यालय सफलतापूर्वक हटाइयो', 'success');

        return back();
    }
}

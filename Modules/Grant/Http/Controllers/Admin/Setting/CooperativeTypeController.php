<?php

namespace Modules\Grant\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Carbon\Factory;
use Illuminate\Console\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Grant\Entities\CooperativeType;
use Modules\Grant\Http\Requests\Setting\CooperativeType\StoreCooperativeTypeRequest;
use Modules\Grant\Http\Requests\Setting\CooperativeType\UpdateCooperativeTypeRequest;
use Illuminate\Database\Eloquent\Builder;

class CooperativeTypeController extends Controller
{
    public function index(): Factory|View|Application
    {
        $this->checkAuthorization('cooperativeType_access');
        $cooperativeTypes = CooperativeType::where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['title'], request('search'));
            }
        })
         ->latest()->paginate(10);
        return view('grant::admin.setting.cooperativeType.index', compact('cooperativeTypes'));
    }

    public function create(): Factory|View|Application
    {
        $this->checkAuthorization('cooperativeType_create');

        return view('grant::admin.setting.cooperativeType.create');
    }

    public function store(StoreCooperativeTypeRequest $request): RedirectResponse
    {
        $this->checkAuthorization('cooperativeType_create');

        CooperativeType::create($request->validated());
        toast('सहकारी प्रकार सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function edit(CooperativeType $cooperativeType)
    {
        $this->checkAuthorization('cooperativeType_edit');
        return view('grant::admin.setting.cooperativeType.edit', compact('cooperativeType'));
    }

    public function update(UpdateCooperativeTypeRequest $request, CooperativeType $cooperativeType)
    {
        $this->checkAuthorization('cooperative_edit');
        $cooperativeType->update($request->validated());
        toast('सहकारी प्रकार सफलता पूर्वक सम्पादन गरियो', 'success');
        return redirect(route('admin.grant.setting.cooperativeType.index'));
    }

    public function destroy(CooperativeType $cooperativeType)
    {
        $this->checkAuthorization('grantType_delete');
        $cooperativeType->delete();

        toast('सहकारी प्रकार सफलतापूर्वक मेटाइयो', 'success');
        return back();
    }
}

<?php

namespace Modules\Identity\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use Modules\Identity\Entities\CardColor;
use Modules\Identity\Entities\GovernmentalDisabilityType;
use Modules\Identity\Http\Requests\StoreGovernmentalDisablityRequest;
use Modules\Identity\Http\Requests\UpdateGovernmentalDisablityRequest;

class GovernmentalDisabilityTypeController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('governmentalDisabilityType_access');
        $governmentalDisabilityTypes = GovernmentalDisabilityType::where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['title_en','title'], request('search'));
            }
        })
            ->latest()->paginate(10);
        return view('identity::admin.setting.governmentalDisabilityType.index', compact('governmentalDisabilityTypes'));
    }

    public function create()
    {
        $this->checkAuthorization('governmentalDisabilityType_create');
        $cardColors = CardColor::all();
        return view('identity::admin.setting.governmentalDisabilityType.create', compact('cardColors'));
    }

    public function store(StoreGovernmentalDisablityRequest $request)
    {
        $this->checkAuthorization('governmentalDisabilityType_create');
        GovernmentalDisabilityType::create($request->validated());
        toast('अपांगताको प्रकार सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(GovernmentalDisabilityType $governmentalDisabilityType)
    {
        $this->checkAuthorization('governmentalDisabilityType_access');
        return view('identity::show');
    }

    public function edit(GovernmentalDisabilityType $governmentalDisabilityType)
    {
        $this->checkAuthorization('governmentalDisabilityType_edit');
        $cardColors = CardColor::all();
        return view('identity::admin.setting.governmentalDisabilityType.edit', compact('cardColors', 'governmentalDisabilityType'));
    }

    public function update(UpdateGovernmentalDisablityRequest $request, GovernmentalDisabilityType $governmentalDisabilityType)
    {
        $this->checkAuthorization('governmentalDisabilityType_edit');
        $governmentalDisabilityType->update($request->validated());
        toast('अपांगताको प्रकार सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('identity.admin.setting.governmentalDisabilityType.index'));
    }

    public function destroy(GovernmentalDisabilityType $governmentalDisabilityType)
    {
        $this->checkAuthorization('governmentalDisabilityType_delete');
        $governmentalDisabilityType->delete();
        toast('अपांगताको प्रकार सफलतापूर्वक मेटियो', 'success');
        return back();
    }
}

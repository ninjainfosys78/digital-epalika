<?php

namespace Modules\Identity\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Identity\Entities\DisabilityReason;
use Modules\Identity\Http\Requests\DisabilityReason\StoreDisabilityReasonRequest;
use Modules\Identity\Http\Requests\DisabilityReason\UpdateDisabilityReasonRequest;

class DisabilityReasonController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('disabilityReason_access');
        $disabilityReasons = DisabilityReason::latest()->paginate(10);
        return view('identity::admin.setting.disabilityReason.index', compact('disabilityReasons'));
    }

    public function create()
    {
        $this->checkAuthorization('disabilityReason_create');
        return view('identity::admin.setting.disabilityReason.create');
    }

    public function store(StoreDisabilityReasonRequest $request)
    {
        $this->checkAuthorization('disabilityReason_create');
        DisabilityReason::create($request->validated());
        toast('अपांगताको कारण सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(DisabilityReason $disabilityReason)
    {
        $this->checkAuthorization('disabilityReason_access');
        return view('identity::show');
    }

    public function edit(DisabilityReason $disabilityReason)
    {
        $this->checkAuthorization('disabilityReason_edit');
        return view('identity::admin.setting.disabilityReason.edit', compact('disabilityReason'));
    }

    public function update(UpdateDisabilityReasonRequest $request, DisabilityReason $disabilityReason)
    {
        $this->checkAuthorization('disabilityReason_edit');
        $disabilityReason->update($request->validated());
        toast('अपांगताको कारण सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('identity.admin.setting.disabilityReason.index'));
    }

    public function destroy(DisabilityReason $disabilityReason)
    {
        $this->checkAuthorization('disabilityReason_delete');
        $disabilityReason->delete();
        toast('अपांगताको कारण सफलतापूर्वक मेटियो', 'success');
        return back();
    }
}

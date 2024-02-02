<?php

namespace Modules\Identity\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Identity\Entities\DisabilityCommittee;
use Modules\Identity\Http\Requests\DisabilityCommittee\StoreDisabilityCommitteeRequest;
use Modules\Identity\Http\Requests\DisabilityCommittee\UpdateDisabilityCommitteeRequest;

class DisabilityCommitteeController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('disabilityCommittee_access');

        $disabilityCommittees = DisabilityCommittee::orderBy('position')->get();

        return view('identity::admin.setting.disabilityCommittee.index', compact('disabilityCommittees'));
    }

    public function create()
    {
        $this->checkAuthorization('disabilityCommittee_create');

        return view('identity::admin.setting.disabilityCommittee.create');
    }

    public function store(StoreDisabilityCommitteeRequest $request)
    {
        $this->checkAuthorization('disabilityCommittee_create');

        DisabilityCommittee::create($request->validated());

        toast('अपाङ्ग समिति सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function edit(DisabilityCommittee $disabilityCommittee)
    {
        $this->checkAuthorization('disabilityCommittee_edit');

        return view('identity::admin.setting.disabilityCommittee.edit', compact('disabilityCommittee'));
    }

    public function update(UpdateDisabilityCommitteeRequest $request, DisabilityCommittee $disabilityCommittee)
    {
        $this->checkAuthorization('disabilityCommittee_edit');

        $disabilityCommittee->update($request->validated());

        toast('अपाङ्ग समिति सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('identity.admin.setting.disabilityCommittee.index'));
    }

    public function destroy(DisabilityCommittee $disabilityCommittee)
    {
        $this->checkAuthorization('disabilityCommittee_delete');

        $disabilityCommittee->delete();

        toast('अपाङ्ग समिति सफलतापूर्वक हटाइयो', 'success');

        return back();
    }
}

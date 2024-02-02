<?php

namespace Modules\ExecutiveMeeting\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\ExecutiveMeeting\Entities\CommitteeType;
use Modules\ExecutiveMeeting\Http\Requests\Setting\CommitteeType\StoreCommitteeTypeRequest;
use Modules\ExecutiveMeeting\Http\Requests\Setting\CommitteeType\UpdateCommitteeTypeRequest;

class CommitteeTypeController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('committeeType_access');

        $committeeTypes = CommitteeType::all();

        return view('executivemeeting::admin.setting.committeeType.index', compact('committeeTypes'));
    }

    public function create()
    {
        $this->checkAuthorization('committeeType_create');

        return view('executivemeeting::admin.setting.committeeType.create');
    }

    public function store(StoreCommitteeTypeRequest $request)
    {
        $this->checkAuthorization('committeeType_create');

        CommitteeType::create($request->validated());

        toast('समिति प्रकार सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function edit(CommitteeType $committeeType)
    {
        $this->checkAuthorization('committeeType_edit');

        return view('executivemeeting::admin.setting.committeeType.edit', compact('committeeType'));
    }

    public function update(UpdateCommitteeTypeRequest $request, CommitteeType $committeeType)
    {
        $this->checkAuthorization('committeeType_edit');

        $committeeType->update($request->validated());

        toast('समिति प्रकार सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.executiveMeeting.setting.committeeType.index'));
    }

    public function destroy(CommitteeType $committeeType)
    {
        $this->checkAuthorization('committeeType_delete');

        $committeeType->delete();

        toast('समिति प्रकार सफलतापूर्वक हटाइयो', 'success');
        return back();
    }
}

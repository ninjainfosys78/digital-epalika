<?php

namespace Modules\ExecutiveMeeting\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\ExecutiveMeeting\Entities\Committee;
use Modules\ExecutiveMeeting\Entities\CommitteeType;
use Modules\ExecutiveMeeting\Http\Requests\Setting\Committee\StoreCommitteeRequest;
use Modules\ExecutiveMeeting\Http\Requests\Setting\Committee\UpdateCommitteeRequest;

class CommitteeController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('committee_access');

        $committees = Committee::with('committeeType')->get();

        return view('executivemeeting::admin.setting.committee.index', compact('committees'));
    }

    public function create()
    {
        $this->checkAuthorization('committee_create');

        $committeeTypes = CommitteeType::all();

        return view('executivemeeting::admin.setting.committee.create', compact('committeeTypes'));
    }

    public function store(StoreCommitteeRequest $request)
    {
        $this->checkAuthorization('committee_create');

        $committeeType = CommitteeType::find($request->input('committee_type_id'));

        if (!$committeeType) {
            toast('समिति प्रकार भेटिएन', 'error');
            return back();
        }

        if (Committee::where('committee_type_id', $committeeType->id)->count() >= $committeeType->committee_no) {
            toast('समितिको अधिकतम क्षमताभन्दा बढी समिति थपिएको छ', 'error');
            return back();
        }

        Committee::create($request->validated() + [
            'user_id' => auth()->id()
        ]);

        toast('समिति सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function edit(Committee $committee)
    {
        $this->checkAuthorization('committee_edit');

        $committeeTypes = CommitteeType::all();

        return view('executivemeeting::admin.setting.committee.edit', compact('committee', 'committeeTypes'));
    }

    public function update(UpdateCommitteeRequest $request, Committee $committee)
    {
        $this->checkAuthorization('committee_edit');

        $committee->update($request->validated());

        toast('समिति सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.executiveMeeting.setting.committee.index'));
    }

    public function destroy(Committee $committee)
    {
        $this->checkAuthorization('committee_delete');

        $committee->delete();

        toast('समिति सफलतापूर्वक हटाइयो', 'success');
        return back();
    }
}

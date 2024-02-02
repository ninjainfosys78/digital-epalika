<?php

namespace Modules\ExecutiveMeeting\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\ExecutiveMeeting\Entities\Committee;
use Modules\ExecutiveMeeting\Entities\CommitteeMember;
use Modules\ExecutiveMeeting\Http\Requests\CommitteeMember\StoreCommitteeMemberRequest;
use Modules\ExecutiveMeeting\Http\Requests\CommitteeMember\UpdateCommitteeMemberRequest;

class CommitteeMemberController extends Controller
{
    public function index(Committee $committee)
    {
        $this->checkAuthorization('committeeMember_access');

        $committeeMembers = CommitteeMember::where('committee_id', $committee->id)->paginate(10);

        return view('executivemeeting::admin.committeeMember.index', compact('committee', 'committeeMembers'));
    }

    public function create(Committee $committee)
    {
        $this->checkAuthorization('committeeMember_create');

        return view('executivemeeting::admin.committeeMember.create', compact('committee'));
    }

    public function store(StoreCommitteeMemberRequest $request, Committee $committee)
    {
        $this->checkAuthorization('committeeMember_create');

        $committee->committeeMembers()->create($request->validated() + [
                'user_id' => auth()->id()
            ]);

        toast('समिति सदस्य सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function edit(Committee $committee, CommitteeMember $committeeMember)
    {
        $this->checkAuthorization('committeeMember_edit');

        return view('executivemeeting::admin.committeeMember.edit', compact('committeeMember', 'committee'));
    }

    public function update(UpdateCommitteeMemberRequest $request, Committee $committee, CommitteeMember $committeeMember)
    {
        $this->checkAuthorization('committeeMember_edit');

        $committeeMember->update($request->validated());

        toast('समिति सदस्य सफलतापूर्वक अपडेट गरियो', 'success');
        return redirect(route('admin.executiveMeeting.committee.committeeMember.index', $committee));
    }

    public function destroy(Committee $committee, CommitteeMember $committeeMember)
    {
        $this->checkAuthorization('committeeMember_delete');

        $committeeMember->delete();
        toast('समिति सदस्य सफलतापूर्वक हटाइयो', 'success');
        return back();
    }
}

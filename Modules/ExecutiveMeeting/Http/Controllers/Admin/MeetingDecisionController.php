<?php

namespace Modules\ExecutiveMeeting\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\ExecutiveMeeting\Entities\Meeting;
use Modules\ExecutiveMeeting\Entities\MeetingDecision;
use Illuminate\Support\Facades\DB;
use Modules\ExecutiveMeeting\Entities\CommitteeMember;
use Modules\ExecutiveMeeting\Entities\InvitedMember;
use Modules\ExecutiveMeeting\Entities\MeetingParticipant;
use Modules\ExecutiveMeeting\Http\Requests\MeetingDecision\StoreMeetingDecisionRequest;
use Modules\ExecutiveMeeting\Http\Requests\MeetingDecision\UpdateMeetingDecisionRequest;

class MeetingDecisionController extends Controller
{
    public function index(Meeting $meeting)
    {
        $this->checkAuthorization('meetingDecision_access');
        return view('executivemeeting::admin.meeting_decision.index', compact('meeting'));
    }

    public function create(Meeting $meeting)
    {
        $this->checkAuthorization('meetingDecision_create');

        $committeeMembers = CommitteeMember::where('committee_id', $meeting->committee_id)->orderBy('position')->get();

        $meeting->load([
            'meetingParticipants',
            'meetingDecision',
            'invitedMembers'
        ]);

        return view('executivemeeting::admin.meeting_decision.create', compact('meeting', 'committeeMembers'));
    }

    public function store(StoreMeetingDecisionRequest $request, Meeting $meeting)
    {
        $this->checkAuthorization('meetingDecision_create');

        $participatingMembers = CommitteeMember::whereIn('id', $request->input('meetingParticipants') ?? [])->orderBy('position')->get();

        DB::transaction(function () use ($request, $meeting, $participatingMembers) {

            MeetingDecision::updateOrCreate(
                ['meeting_id' => $meeting->id],
                [
                    'date' => $request->input('date'),
                    'chairman' => $request->input('chairman'),
                    'en_date' => $request->input('en_date'),
                    'description' => $request->input('description'),
                    'user_id' => auth()->id()
                ]
            );
            $existingId = collect($meeting->invitedMembers?->pluck('id'));
            $newId = collect();
            if (!empty($request->validated()['invitedMember'])) {

                foreach ($request->validated()['invitedMember'] as $invitedMember) {
                    $invitedData = InvitedMember::create(
                        [
                            'meeting_id' => $meeting->id,
                            'name' => $invitedMember['name'],
                            'designation' => $invitedMember['designation'],
                            'phone' => $invitedMember['phone'],
                            'email' => $invitedMember['email'],
                        ]
                    );
                    $newId->push($invitedData->id);
                }
            }

            $diff = $existingId->diff($newId->filter());
            InvitedMember::whereIn('id', $diff->toArray())->delete();


            foreach ($participatingMembers as $member) {
                MeetingParticipant::updateOrCreate(
                    ['meeting_id' => $meeting->id, 'committee_member_id' => $member->id],
                    [
                        'name' => $member->name,
                        'designation' => $member->designation,
                        'phone' => $member->phone,
                        'email' => $member->email,
                    ]
                );
            }

            $meeting->meetingParticipants()->whereNotIn('committee_member_id', $request->input('meetingParticipants') ?? [])->delete();
        });

        toast('बैठक निर्णय सफलतापूर्वक थपियो', 'success');
        return redirect(route('admin.executiveMeeting.meeting.meetingDecision.index', $meeting));
    }



    public function show(Meeting $meeting, MeetingDecision $meetingDecision)
    {
        $this->checkAuthorization('meetingDecision_access');
    }

    public function edit(Meeting $meeting, MeetingDecision $meetingDecision)
    {
        $this->checkAuthorization('meetingDecision_edit');
        return view('executivemeeting::admin.meeting_decision.edit', compact('meeting', 'meetingDecision'));
    }

    public function update(UpdateMeetingDecisionRequest $request, Meeting $meeting, MeetingDecision $meetingDecision)
    {
        $this->checkAuthorization('meetingDecision_edit');

        $meetingDecision->update($request->validated());

        toast('बैठक निर्णय सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.executiveMeeting.meeting.meetingDecision.index', $meeting));
    }

    public function destroy(Meeting $meeting, MeetingDecision $meetingDecision)
    {
        $this->checkAuthorization('meetingDecision_delete');

        $meetingDecision->delete();

        toast('बैठक निर्णय सफलतापूर्वक हटाइयो', 'success');

        return back();
    }
}

<?php

namespace Modules\ExecutiveMeeting\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\ExecutiveMeeting\Entities\Meeting;
use Modules\ExecutiveMeeting\Entities\MeetingAgenda;
use Modules\ExecutiveMeeting\Http\Requests\MeetingAgenda\StoreMeetingAgendaRequest;
use Modules\ExecutiveMeeting\Http\Requests\MeetingAgenda\UpdateMeetingAgendaRequest;

class MeetingAgendaController extends Controller
{
    public function index(Meeting $meeting)
    {
        $this->checkAuthorization('meetingAgenda_access');

        $meeting->load('meetingAgendas');

        return view('executivemeeting::admin.meetingAgenda.index', compact('meeting'));
    }

    public function create(Meeting $meeting)
    {
        $this->checkAuthorization('meetingAgenda_create');

        return view('executivemeeting::admin.meetingAgenda.create', compact('meeting'));
    }

    public function store(StoreMeetingAgendaRequest $request, Meeting $meeting)
    {
        $this->checkAuthorization('meetingAgenda_create');

        $meeting->meetingAgendas()->create($request->validated());

        toast('बैठकको एजेन्डा सफलतापूर्वक थपियो', 'success');

        return redirect(route('admin.executiveMeeting.meeting.meetingAgenda.index', $meeting));
    }

    public function show(Meeting $meeting, MeetingAgenda $meetingAgenda)
    {
        $this->checkAuthorization('meetingAgenda_access');

        return view('executivemeeting::show');
    }

    public function edit(Meeting $meeting, MeetingAgenda $meetingAgenda)
    {
        $this->checkAuthorization('meetingAgenda_edit');

        return view('executivemeeting::admin.meetingAgenda.edit', compact('meeting', 'meetingAgenda'));
    }

    public function update(UpdateMeetingAgendaRequest $request, Meeting $meeting, MeetingAgenda $meetingAgenda)
    {
        $this->checkAuthorization('meetingAgenda_edit');

        $meetingAgenda->update($request->validated());

        toast('बैठकको एजेन्डा सफलतापूर्वक अपडेट गरियो', 'success');
        return redirect(route('admin.executiveMeeting.meeting.meetingAgenda.index', $meeting));
    }

    public function destroy(Meeting $meeting, MeetingAgenda $meetingAgenda)
    {
        $this->checkAuthorization('meetingAgenda_delete');

        $meetingAgenda->delete();

        toast('एजेन्डा सफलतापूर्वक हटाइयो', 'success');
        return back();
    }

    public function updateStatus(Meeting $meeting, MeetingAgenda $meetingAgenda)
    {
        $this->checkAuthorization('meetingAgenda_edit');

        $meetingAgenda->update([
            'is_final' => !$meetingAgenda->is_final
        ]);

        toast('एजेन्डा स्थिति सफलतापुर्बक अद्यावधिक गरियो', 'success');

        return back();
    }
}

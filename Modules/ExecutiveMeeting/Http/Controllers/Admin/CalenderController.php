<?php

namespace Modules\ExecutiveMeeting\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ExecutiveMeeting\Entities\Committee;
use Modules\ExecutiveMeeting\Entities\Meeting;
use Modules\ExecutiveMeeting\Transformers\MeetingResource;

class CalenderController extends Controller
{
    public function index()
    {
        $committees = Committee::all();

        return view('executivemeeting::admin.meeting.calendar', compact('committees'));
    }

    public function getData(Request $request)
    {
        $meetings = Meeting::get();

        return MeetingResource::collection($meetings);
    }
}

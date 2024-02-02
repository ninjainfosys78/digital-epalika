<?php

namespace Modules\Roaster\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Roaster\Entities\Attendance;
use Modules\Roaster\Entities\Trainee;
use Modules\Roaster\Entities\Training;
use Modules\Roaster\Http\Requests\Attendance\StoreAttendanceRequest;
use Modules\Roaster\Http\Requests\Attendance\UpdateAttendanceRequest;

class AttendanceController extends Controller
{
    public function index(Training $training, Trainee $trainee)
    {
        $attendances = Attendance::where('training_id', $training->id)
            ->where('trainee_id', $trainee->id)
            ->get();
        return view('roaster::traineeUser.attendance.index', compact('attendances', 'training', 'trainee'));
    }

    public function create(Training $training, Trainee $trainee)
    {
        return view('roaster::traineeUser.attendance.create', compact('training', 'trainee'));
    }

    public function store(StoreAttendanceRequest $request, Training $training, Trainee $trainee)
    {
        Attendance::create($request->validated() + [
            'training_id' => $training->id,
            'trainee_id' => $trainee->id,
        ]);
        toast('हाजिरी सफलता पूर्ण थपियो', 'success');
        return back();
    }

    public function show(Training $training, Trainee $trainee, Attendance $attendance)
    {
        return view('roaster::show');
    }

    public function edit(Training $training, Trainee $trainee, Attendance $attendance)
    {
        return view('roaster::traineeUser.attendance.edit', compact('training', 'trainee', 'attendance'));
    }

    public function update(UpdateAttendanceRequest $request, Training $training, Trainee $trainee, Attendance $attendance)
    {
        $attendance->update($request->validated());
        toast('हाजिरी सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    public function destroy(Training $training, Trainee $trainee, Attendance $attendance)
    {
        $attendance->delete();
        toast('हाजिरी सफलतापूर्वक मेटियो', 'success');
        return back();
    }
}

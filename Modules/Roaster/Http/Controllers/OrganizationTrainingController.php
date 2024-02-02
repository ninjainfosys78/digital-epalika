<?php

namespace Modules\Roaster\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\SelectedTraineeNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Modules\Roaster\Entities\RoasterSetting;
use Modules\Roaster\Entities\TechnicalTrainee;
use Modules\Roaster\Entities\Trainee;
use Modules\Roaster\Entities\TraineeUser;
use Modules\Roaster\Entities\Trainer;
use Modules\Roaster\Entities\Training;

class OrganizationTrainingController extends Controller
{
    public function index()
    {

        $trainings = Training::withCount('trainingTrainees')->whereNull('closed_at')
            ->get()->filter(function ($data) {
                return $data->form_status_according_to_organization_date === true;
            });
        $trainers = Trainer::selectRaw('id,name')->latest()->get();
        return view('roaster::traineeUser.training.index', compact('trainings', 'trainers'));
    }

    public function traineeList(Training $training)
    {

        $trainees = Trainee::with('designation', 'department', 'ethnicity', 'localBody', 'district', 'province')->whereHas('trainingTrainee', function ($query) use ($training) {
            $query->where('training_id', $training->id);
        })->paginate(20);

        return view('roaster::traineeUser.trainee.index', compact('training', 'trainees'));
    }

    public function updateSelectTrainee(Request $request, Trainee $trainee)
    {
        $trainee->load('trainingTrainee.training');
        if ($request->input('select') == 'Verified') {
            toast('You Can not verify', 'error');
            return back();
        }
        DB::transaction(function () use ($request, $trainee) {
            $trainee->update([
                'select' => $request->input('select'),
            ]);

            $roasterSetting = RoasterSetting::first() ?? null;
            if (!empty($roasterSetting && $roasterSetting->is_verified == 1)) {
                $trainee->update([
                    'select' => 'Verified',
                ]);
            }
            $traineeUser = TraineeUser::find(auth('traineeUser')->user()->id);
            Notification::send(User::all(), new SelectedTraineeNotification($trainee, $traineeUser));
        });

        toast('Trainee updated successfully', 'success');

        return back();
    }
    public function updateSelectTechnicalTrainee(Request $request, TechnicalTrainee $technicalTrainee)
    {
        $technicalTrainee->update([
            'select' => $request->input('select'),
        ]);
        toast('Trainee updated successfully', 'success');

        return back();
    }


    public function create()
    {
        return view('roaster::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function showTrainee(Training $training, Trainee $trainee)
    {

        $trainee->load('province', 'district', 'localBody', 'ethnicity', 'documents', 'designation', 'department');

        return view('roaster::traineeUser.trainee.show', compact('trainee'));
    }

    public function editTrainee(Training $training, Trainee $trainee)
    {
        $trainee->load('trainingTrainee');

        return view('roaster::traineeUser.trainee.edit', compact('trainee'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

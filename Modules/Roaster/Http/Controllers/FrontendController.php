<?php

namespace Modules\Roaster\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Roaster\Entities\Training;

class FrontendController extends Controller
{
    public function index()
    {
        $trainings = Training::whereNull('closed_at')->get();

        return view('roaster::frontend.index', compact('trainings'));
    }

    public function trainerForm()
    {
        return view('roaster::frontend.trainer-form');
    }

    public function application()
    {
        return view('roaster::frontend.application');
    }

    public function traineeForm(Training $training)
    {
        return view('roaster::frontend.trainee', compact('training'));
    }

    public function technicalTraineeForm(Training $training)
    {
        return view('roaster::frontend.technicalTrainee', compact('training'));
    }

    public function individualTrainingView($trainingType)
    {
        $trainings = Training::with('trainers')->whereNull('closed_at')
            ->get()->filter(function ($data) {
                return $data->form_status_according_to_trainee_date === true;
            });

        return view('roaster::frontend.trainings', compact('trainings', 'trainingType'));
    }

    public function traineeRegister()
    {
        return view('roaster::frontend.traineeRegister');
    }
}

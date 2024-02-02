<?php

namespace Modules\Roaster\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Modules\Roaster\Entities\Trainer;

class TrainerController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('training_access');

        $trainers = Trainer::with('department', 'designation')->where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['name', 'level', 'ward'], request('search'));
            }
        })
        ->latest()->paginate(10);


        return view('roaster::admin.trainer.index', compact('trainers'));
    }

    public function create()
    {
        return view('roaster::create');
    }

    public function show(Trainer $trainer)
    {
        $this->checkAuthorization('training_access');

        $trainer->load(
            'designation',
            'department',
            'province',
            'localBody',
            'district',
            'subjects',
            'trainerDocuments',
            'trainerExperienceInTrainings',
            'trainerExperienceAsTrainees',
            'trainerExperiences.designation',
            'trainerQualifications',
            'trainerBankDetails'
        );

        return view('roaster::admin.trainer.show', compact('trainer'));
    }

    public function edit(Trainer $trainer)
    {
        $this->checkAuthorization('training_edit');
        $trainer->load(
            'trainerDocuments',
            'trainerExperienceInTrainings',
            'trainerExperienceAsTrainees',
            'trainerExperiences.designation',
            'trainerQualifications',
            'trainerBankDetails'
        );

        return view('roaster::admin.trainer.edit', compact('trainer'));
    }
}

<?php

namespace Modules\Roaster\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Roaster\Entities\Trainee;

class TraineeController extends Controller
{
    public function show(Trainee $trainee)
    {
        $this->checkAuthorization('trainee_access');
        $trainee->load('province', 'district', 'localBody', 'ethnicity', 'documents', 'designation', 'department');

        return view('roaster::admin.training.trainee.show', compact('trainee'));
    }

    public function edit(Trainee $trainee)
    {
        $this->checkAuthorization('trainee_edit');
        $trainee->load('trainingTrainee');

        return view('roaster::admin.training.trainee.edit', compact('trainee'));
    }

    public function updateSelectTrainee(Trainee $trainee)
    {
        $this->checkAuthorization('trainee_access');
        $trainee->update([
            'select' => !$trainee->select,
        ]);
        toast('Trainee updated successfully', 'success');

        return back();
    }
}

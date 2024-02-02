<?php

namespace Modules\Roaster\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Roaster\Entities\TechnicalTrainee;

class TechnicalTraineeController extends Controller
{
    public function show(TechnicalTrainee $technicalTrainee)
    {
        $this->checkAuthorization('technicalTrainee_access');

        $technicalTrainee->load('province', 'district', 'localBody', 'documents', 'department', 'designation');

        return view('roaster::admin.training.technicalTrainee.show', compact('technicalTrainee'));
    }

    public function edit(TechnicalTrainee $technicalTrainee)
    {
        $this->checkAuthorization('technicalTrainee_edit');
        $technicalTrainee->load('trainingTrainee');

        return view('roaster::admin.training.technicalTrainee.edit', compact('technicalTrainee'));
    }

    public function updateSelectTechnicalTrainee(TechnicalTrainee $technicalTrainee)
    {
        $this->checkAuthorization('technicalTrainee_access');
        $technicalTrainee->update([
            'select' => !$technicalTrainee->select,
        ]);
        toast('Technical Trainee updated successfully', 'success');

        return back();
    }
}

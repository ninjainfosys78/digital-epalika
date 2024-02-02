<?php

namespace Modules\Roaster\Http\Controllers;

use App\Enums\Gender;
use App\Http\Controllers\Controller;
use App\Models\Ethnicity;
use App\Models\Settings\Department;
use App\Models\Settings\Designation;
use Illuminate\Support\Facades\DB;
use Modules\Roaster\Entities\Subject;
use Modules\Roaster\Entities\Training;
use Modules\Roaster\Http\Requests\Trainee\StoreTraineeRequest;
use Modules\Roaster\Transformers\TraineeResource;

class TraineeApiController extends Controller
{
    public function training()
    {
        $trainings = Training::with('trainers')->whereNull('closed_at')
            ->get()->filter(function ($data) {
                return $data->form_status_according_to_trainee_date === true;
            });

        return response()->json(TraineeResource::collection($trainings));
    }

    public function show(Training $training)
    {
        return TraineeResource::make($training);
    }

    public function traineeSetting()
    {
        return [
            'departments' => Department::selectRaw('id,title')->get(),
            'designation' => Designation::selectRaw('id,title')->get(),
            'subjects' => Subject::selectRaw('id,title,level,duration,content')->get(),
            'ethnicities' => Ethnicity::selectRaw('id,title')->get(),
            'genders' => Gender::getValuesWithLabels()
        ];
    }

    public function store(StoreTraineeRequest $request, Training $training)
    {
        DB::transaction(function () use ($request, $training) {

            $trainee = auth()->user()?->trainees()?->create($request->validated());
            $trainee->trainingTrainee()->create([
                'training_id' => $training->id,
            ]);
            if (!empty($request->validated()['documents'])) {
                foreach ($request->validated()['documents'] as $document) {
                    $trainee->documents()->create($document);
                }
            }
            return $trainee;
        });


        return response()->json([
            'message' => 'Trainee Stored Successfully'
        ]);
    }
}

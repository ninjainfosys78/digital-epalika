<?php

namespace Modules\Roaster\Http\Controllers;

use App\Exports\TraineeExport;
use App\Http\Controllers\Controller;
use App\Mail\TraineeVerifiedMail;
use App\Models\Settings\FiscalYear;
use App\Models\Settings\OfficeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Roaster\Entities\Trainee;
use Modules\Roaster\Entities\Trainer;
use Modules\Roaster\Entities\Training;
use Modules\Roaster\Http\Requests\Training\StoreTrainingRequest;
use Modules\Roaster\Http\Requests\Training\UpdateTrainingMarkRequest;
use Modules\Roaster\Http\Requests\Training\UpdateTrainingRequest;

class TrainingController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('training_access');
        $trainings = Training::withCount('trainingTrainees')->latest()->get();
        $trainers = Trainer::selectRaw('id,name')->latest()->get();

        return view('roaster::admin.training.index', compact('trainings', 'trainers'));
    }

    public function create()
    {
        return view('roaster::create');
    }

    public function store(StoreTrainingRequest $request)
    {
        $this->checkAuthorization('training_create');

        $setting = OfficeSetting::first();
        if (!$setting->fiscal_year_id) {
            toast('Fiscal year not added in setting', 'error');

            return back();
        }
        DB::transaction(function () use ($request, $setting) {
            $training = Training::create($request->validated() + [
                'fiscal_year_id' => $setting->fiscal_year_id,
            ]);
            $training->trainers()->sync($request->input('trainers'));
        });
        toast('Training Added Successfully', 'success');

        return back();
    }

    public function show(Training $training)
    {
        $this->checkAuthorization('training_access');


        $trainees = Trainee::with('designation', 'department', 'ethnicity', 'localBody', 'district', 'province')->whereHas('trainingTrainee', function ($query) use ($training) {
            $query->where('training_id', $training->id);
        })->paginate(20);


        return view('roaster::admin.training.show', compact('trainees', 'training'));
    }

    public function updateSelectTrainee(Request $request, Training $training, Trainee $trainee)
    {
        $trainee->load('trainingTrainee.training');
        if ($request->input('select') == 'Selected') {
            toast('You Can not selected', 'error');
            return back();
        }
        DB::transaction(function () use ($request, $trainee, $training) {
            $trainee->update([
                'select' => $request->input('select'),
            ]);

            Mail::to($trainee->email_id)->send(new TraineeVerifiedMail($training, $trainee));
        });
        toast('Trainee updated successfully', 'success');

        return back();
    }

    public function edit(Training $training)
    {
        $this->checkAuthorization('training_edit');

        $training->load('fiscalYear');
        $fiscalYears = FiscalYear::get();
        $trainers = Trainer::selectRaw('id,name')->latest()->get();

        return view('roaster::admin.training.edit', compact('training', 'fiscalYears', 'trainers'));
    }

    public function update(UpdateTrainingRequest $request, Training $training)
    {
        $this->checkAuthorization('training_edit');
        DB::transaction(function () use ($request, $training) {
            $training->update($request->validated() + [
                'closed_at' => $request->input('form_status') == 1 ? now() : null,
            ]);
            $training->trainers()->sync($request->input('trainers'));
        });

        toast('Training Updated Successfully', 'success');

        return redirect(route('admin.roaster.training.index'));
    }

    public function destroy(Training $training)
    {
        $this->checkAuthorization('training_delete');
        $training->trainingTrainees()->delete();
        $training->delete();

        toast('Training Deleted Successfully', 'success');

        return redirect(route('admin.roaster.training.index'));
    }

    public function pdfExport(Training $training)
    {
        $training->load(['trainingTrainees.model' => function ($query) {
            $query->with('province', 'district', 'localBody', 'designation', 'department', 'ethnicity');
        }]);
        if ($training->trainingTrainees) {
            $trainees = $training->trainingTrainees->pluck('model');
        } else {
            $trainees = collect();
        }

        return view('roaster::admin.training.print_trainee', compact('training', 'trainees'));
    }

    public function setFormStatus(Training $training)
    {
        $this->checkAuthorization('training_access');

        $training->update([
            'closed_at' => empty($training->closed_at) ? now() : null,
        ]);

        toast('Training Status Updated Successfully', 'success');

        return redirect(route('admin.roaster.training.index'));
    }

    public function report(Training $training)
    {
        $this->checkAuthorization('training_access');

        $training->load(
            'trainingTrainees.model.localBody',
            'trainingTrainees.model.district',
            'trainingTrainees.model.province',
            'trainers.localBody',
            'trainers.district',
            'trainers.province',
            'trainers.designation',
        );

        return view($training->form_type === 'technicalTrainee' ? 'roaster::admin.training.technicalTraineeReport' : 'roaster::admin.training.report', compact('training'));
    }

    public function storePhotos(Request $request, Training $training)
    {
        $this->checkAuthorization('training_edit');

        $request->validate([
            'images' => ['required', 'array'],
            'images.*' => ['image', 'max:300'],
        ]);

        foreach ($request->file('images') as $image) {
            $training->documents()->create([
                'document' => $image,
            ]);
        }

        toast('Photos Added Successfully', 'success');

        return redirect()->back();
    }

    public function marks(Training $training)
    {
        $this->checkAuthorization('training_edit');

        return view('roaster::admin.training.mark-sheet', compact('training'));
    }

    public function updateMarks(UpdateTrainingMarkRequest $request, Training $training)
    {
        $this->checkAuthorization('training_edit');

        $training->update($request->validated());

        toast('Marks Updated Successfully', 'success');

        return redirect()->back();
    }

    public function excelExport(Training $training)
    {
        $training->load(['trainingTrainees.model' => function ($query) {
            $query->with('province', 'district', 'localBody', 'designation', 'department', 'ethnicity');
        }]);
        if ($training->trainingTrainees) {
            $trainees = $training->trainingTrainees->pluck('model');
        } else {
            $trainees = collect();
        }

        return Excel::download(new TraineeExport($trainees, $training), $training->name . '.xlsx');
    }
}

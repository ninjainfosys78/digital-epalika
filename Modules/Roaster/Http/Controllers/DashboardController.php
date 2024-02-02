<?php

namespace Modules\Roaster\Http\Controllers;

use App\Enums\ChartOptionEnum;
use App\Http\Controllers\Controller;
use App\Models\Settings\Department;
use App\Models\Settings\FiscalYear;
use App\Traits\NepaliDateConverter;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Roaster\Entities\Subject;
use Modules\Roaster\Entities\Trainer;
use Modules\Roaster\Entities\Training;
use Modules\Roaster\Enums\TrainingTypeEnum;

class DashboardController extends Controller
{
    use NepaliDateConverter;

    private Collection $trainers;
    private Collection $trainings;
    private Collection $trainee;
    private Collection $technicalTrainee;

    public function __construct()
    {
        parent::__construct();

        $this->trainers = Trainer::all();
        $this->trainings = Training::with('trainingTrainees')->get();
        $this->trainee = DB::table('trainees')->whereNull('deleted_at')->get();
        $this->technicalTrainee = DB::table('technical_trainees')->whereNull('deleted_at')->get();
    }

    public function index()
    {
        $this->checkAuthorization('roasterDashboard_access');
        $trainerCount = $this->trainers->count();
        $trainingCount = $this->trainings->count();
        $traineeCount = $this->trainee->count();
        $technicalTraineeCount = $this->technicalTrainee->count();
        return view('roaster::admin.dashboard', compact(['trainerCount',
            'trainingCount',
            'traineeCount',
            'technicalTraineeCount']));
    }
    public function ajaxData()
    {
        return [
            'trainingAccordingToFiscalYear' => $this->trainingAccordingToFiscalYear(),
            'trainingAccordingToMonth' => $this->trainingAccordingToMonth(),
            'trainerAccordingToSubject' => $this->trainerAccordingToSubject(),
            'trainingAccordingToType' => $this->trainingAccordingToType(),
            'trainerAccordingToDepartment' => $this->trainerAccordingToDepartment()
        ];
    }
    public function trainingAccordingToFiscalYear()
    {
        $fiscalYears = FiscalYear::withCount('trainings')
            ->get()
            ->map(function ($fiscalYear) {
                return [
                    'title' => $fiscalYear->title,
                    'trainings_count' => (int)$fiscalYear->trainings_count,
                ];
            });

        return [
            'labels' => $fiscalYears->pluck('title')->toArray(),
            'dataSets' => [
                [
                    'data' => $fiscalYears->pluck('trainings_count')->toArray(),
                    'label' => 'जम्मा तालिमहरु',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ]
            ],
        ];
    }
    public function trainingAccordingToMonth()
    {
        $month = [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0];

        foreach ($this->trainings->where('fiscal_year_id', officeSetting()->fiscal_year_id) as $training) {
            $open_date = Carbon::parse($training->open_date);
            $openDate = $this->get_nepali_date(
                $open_date->format('Y'),
                $open_date->format('m'),
                $open_date->format('d')
            );
            $month[$openDate['m'] - 1] += 1;
        }
        return [
            'labels' => $this->month_name,
            'dataSets' => [
                [
                    'data' => $month,
                    'label' => 'तालिम',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ]
            ]
        ];
    }

    public function trainerAccordingToSubject()
    {
        $subjects = Subject::withCount('trainers')
            ->get()
            ->map(function ($subject) {
                return [
                    'title' => $subject->title,
                    'trainers_count' => (int)$subject->trainers_count,
                ];
            });

        $labelColors = collect([]);

        // Generate random colors for labels
        $subjects->each(function ($subject) use ($labelColors) {
            $labelColors->push(generateRandomRGBAColor());
        });

        return [
            'labels' => $subjects->pluck('title')->toArray(),
            'dataSets' => [
                [
                    'data' => $subjects->pluck('trainers_count')->toArray(),
                    'label' => 'Trainers Count',
                    'backgroundColor' => $labelColors->toArray(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ],
            ],
        ];
    }



    public function trainingAccordingToType()
    {
        $trainingTypeEnums = TrainingTypeEnum::cases();
        $label = collect();
        $data = collect();
        $color = collect();
        foreach ($trainingTypeEnums as $trainingTypeEnum) {
            $count = $this->trainings
                ->where('form_type', $trainingTypeEnum->value)
                ->count();
            $label->push($trainingTypeEnum->label() ." (".$count.")");
            $data->push($count);
            $color->push(generateRandomRGBAColor());
        }
        return [
            'labels' => $label,
            'option' => ChartOptionEnum::PIE_CHART->option(),
            'dataSets' => [
                [
                    'data' => $data,
                    'backgroundColor' => $color,
                    'borderColor' => $color,
                    'borderWidth' => 1,
                ],
            ],
        ];
    }
    public function trainerAccordingToDepartment()
    {
        $departments = Department::withCount('trainers')
            ->get()
            ->map(function ($department) {
                return [
                    'name' => $department->title . " (" . $department->trainers_count . ")",
                    'data' => (int)$department->trainers_count,
                    'color' => generateRandomRGBAColor() // If you have a function to generate random colors
                ];
            });

        return [
            'labels' => $departments->pluck('name')->toArray(),
            'option' => ChartOptionEnum::PIE_CHART->option(),
            'dataSets' => [
                [
                    'data' => $departments->pluck('data')->toArray(),
                    'backgroundColor' => $departments->pluck('color')->toArray(),
                    'borderColor' => $departments->pluck('color')->toArray(),
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

}

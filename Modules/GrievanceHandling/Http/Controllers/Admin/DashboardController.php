<?php

namespace Modules\GrievanceHandling\Http\Controllers\Admin;

use App\Enums\ChartOptionEnum;
use App\Http\Controllers\Controller;
use App\Models\Settings\Branch;
use App\Traits\NepaliDateConverter;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\GrievanceHandling\Entities\GrievanceType;
use Modules\GrievanceHandling\Enums\GrievanceComplaintSeverity;
use Modules\GrievanceHandling\Enums\GrievanceStatus;

class DashboardController extends Controller
{
    use NepaliDateConverter;

    public Collection $grievanceDetails;

    public function __construct()
    {
        parent::__construct();
        $this->grievanceDetails = DB::table('grievance_details')->whereNull('grievance_detail_id')->whereNull('deleted_at')->get();
    }

    public function index()
    {
        $this->checkAuthorization('grievanceHandlingDashboard_access');

        $grievanceCount = $this->grievanceDetails->count();
        $registeredGrievanceCount = $this->grievanceDetails->where('is_approved', 0)->count();
        $publicGrievanceCount = $this->grievanceDetails->where('is_public', 1)->count();
        $unseenGrievanceCount = $this->grievanceDetails->where('status', GrievanceStatus::UNSEEN->value)->count();
        $closedGrievanceCount = $this->grievanceDetails->where('status', GrievanceStatus::CLOSED->value)->count();
        $investigatedGrievanceCount = $this->grievanceDetails->where('status', GrievanceStatus::INVESTIGATED->value)->count();
        $seenGrievanceCount = $this->grievanceDetails->where('status', '!=', GrievanceStatus::UNSEEN->value)->count();

        return view('grievancehandling::admin.dashboard', compact(
            'seenGrievanceCount',
            'registeredGrievanceCount',
            'publicGrievanceCount',
            'grievanceCount',
            'unseenGrievanceCount',
            'closedGrievanceCount',
            'investigatedGrievanceCount'
        ));
    }

    public function ajaxData()
    {
        return [
            'grievanceCountAccordingToSeverity' => $this->getDataAccordingToSeverity(),
            'grievanceCountAccordingToStatus' => $this->getDataAccordingToStatus(),
            'dataAccordingToGrievanceType' => $this->getDataAccordingToGrievanceType(),
            'dataAccordingToGrievanceOffice' => $this->getDataAccordingToGrievanceOffice(),
            'getDataAccordingToMonth' => $this->getDataAccordingToMonth(),
        ];
    }

    public function getDataAccordingToSeverity(): array
    {
        $grievanceComplaintSeverity = GrievanceComplaintSeverity::cases();

        $label = collect();
        $data = collect();
        $color = collect();

        foreach ($grievanceComplaintSeverity as $grievanceSeverity) {
            $count = $this->grievanceDetails
                ->where('complaint_severity', $grievanceSeverity->value)
                ->count();

            $label->push($grievanceSeverity->label() ." (".$count.")");
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

    public function getDataAccordingToStatus()
    {
        $grievanceComplaintStatuses = GrievanceStatus::cases();
        $label = collect();
        $data = collect();
        $color = collect();

        foreach ($grievanceComplaintStatuses as $grievanceComplaintStatus) {
            $count = $this->grievanceDetails
                ->where('status', $grievanceComplaintStatus->value)
                ->count();

            $label->push($grievanceComplaintStatus->label() ." (".$count.")");
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

    public function getDataAccordingToGrievanceType()
    {
        $grievanceTypes = GrievanceType::withCount(['grievanceDetails' => function ($query) {
            $query->whereNull('grievance_detail_id');
        }])->get()->map(function ($grievanceTypes) {
            return [
                'name' => $grievanceTypes->title ." (".$grievanceTypes->grievance_details_count.")",
                'data' => $grievanceTypes->grievance_details_count,

            ];
        });

        return [
            'labels' => $grievanceTypes->pluck('name')?->toArray(),
            'option' => ChartOptionEnum::PIE_CHART->option(),
            'dataSets' => [
                [
                    'data' => $grievanceTypes->pluck('data')?->toArray(),
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    public function getDataAccordingToGrievanceOffice()
    {
        $branches = Branch::withCount(['grievanceDetails' => function ($query) {
            $query->whereNull('grievance_detail_id');
        }])
            ->get()
            ->map(function ($branch) {
                return [
                    'name' => $branch->title." (".$branch->grievance_details_count.")",
                    'data' => $branch->grievance_details_count,
                    'color' => generateRandomRGBAColor()
                ];
            });

        return [
            'labels' => $branches->pluck('name')?->toArray(),
            'option' => ChartOptionEnum::PIE_CHART->option(),
            'dataSets' => [
                [
                    'data' => $branches->pluck('data')?->toArray(),
                    'backgroundColor' => $branches->pluck('color')?->toArray(),
                    'borderColor' => $branches->pluck('color')?->toArray(),
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    public function getDataAccordingToMonth()
    {
        $totalCount = collect([0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0]);

        $this->grievanceDetails
            ->each(function ($grievanceDetail) use ($totalCount) {
                $date = Carbon::parse($grievanceDetail->created_at);
                $nepaliDate = $this->get_nepali_date($date->format('Y'), $date->format('m'), $date->format('d'));
                $totalCount[(int)$nepaliDate['m'] - 1] += 1;
            });

        return [
            'labels' => $this->month_name,
            'option' => ChartOptionEnum::BAR_CHART->option(),
            'dataSets' => [
                [
                    'data' => $totalCount,
                    'label' => 'जम्मा',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ],
            ],
        ];
    }
}

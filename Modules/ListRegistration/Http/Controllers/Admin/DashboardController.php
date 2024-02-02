<?php

namespace Modules\ListRegistration\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings\OfficeSetting;
use App\Traits\NepaliDateConverter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\ListRegistration\Enums\ApplicantCategoryEnum;
use Modules\ListRegistration\Enums\BusinessNatureEnum;

class DashboardController extends Controller
{
    use NepaliDateConverter;

    protected Collection $listRegistrations;
    protected OfficeSetting $officeSetting;

    public function __construct()
    {
        parent::__construct();
        $this->listRegistrations = DB::table('list_registrations')
            ->selectRaw('applicant_type,business_nature,date,en_date,fiscal_year_id')
            ->whereNull('deleted_at')
            ->get();
    }

    public function index()
    {
        $this->checkAuthorization('listRegistrationDashboard_access');

        $nepali_date = $this->get_nepali_date(today()->format('Y'), today()->format('m'), today()->format('d'));
        $totalRegistrations = $this->listRegistrations->count();
        $yearlyRegistrations = $this->listRegistrations
            ->where('fiscal_year_id', officeSetting()->fiscal_year_id)
            ->count();
        $weeklyRegistrations =  $this->listRegistrations
            ->whereBetween('en_date', [now()->subWeek()->toDateString(), now()->toDateString() ])
            ->count();
        $monthlyRegistrations = $this->listRegistrations
            ->where('fiscal_year_id', officeSetting()->fiscal_year_id)
            ->filter(function ($Lr) use ($nepali_date) {
                $date = explode('-', $Lr->date);
                return $date[1] == $nepali_date['m'];
            })
            ->count();

        return view(
            'listregistration::admin.dashboard',
            compact(
                'totalRegistrations',
                'yearlyRegistrations',
                'monthlyRegistrations',
                'weeklyRegistrations'
            )
        );
    }

    public function ajaxData()
    {
        return [
            'applicantTypeWiseData' => $this->getApplicantTypeWiseData(),
            'businessNatureWiseData' => $this->getBusinessNatureWiseData(),
            'monthWise' => $this->getAccordingToMonth()
        ];
    }

    private function getApplicantTypeWiseData()
    {
        $applicantTypeWiseData = collect();

        foreach (ApplicantCategoryEnum::cases() as $applicantType) {
            $applicantTypeWiseData->push([
                'name' => $applicantType->label(),
                'data' => $this->listRegistrations
                    ->where('fiscal_year_id', officeSetting()->fiscal_year_id)
                    ->where('applicant_type', $applicantType->value)
                    ->count()
            ]);
        }

        return $applicantTypeWiseData;
    }

    private function getBusinessNatureWiseData()
    {
        $businessNatureWiseData = collect();

        foreach (BusinessNatureEnum::cases() as $businessNature) {
            $businessNatureWiseData->push([
                'name' => $businessNature->label(),
                'data' => $this->listRegistrations
                    ->where('fiscal_year_id', officeSetting()->fiscal_year_id)
                    ->where('business_nature', $businessNature->value)
                    ->count()
            ]);
        }

        return $businessNatureWiseData;
    }
    public function getAccordingToMonth()
    {
        $totalCount = collect([0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0]);

        $this->listRegistrations->where('fiscal_year_id', officeSetting()->fiscal_year_id)
            ->each(function ($notice) use ($totalCount) {
                $nepaliDate = explode('-', $notice->date);
                $totalCount[(int)$nepaliDate[1] - 1] += 1;
            });

        return [
            'labels' => $this->month_name,
            'dataSets' => [
                [
                    'data' => $totalCount,
                    'label' => 'दर्ता'
                ],
            ],
        ];
    }
}

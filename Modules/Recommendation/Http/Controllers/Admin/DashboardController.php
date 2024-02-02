<?php

namespace Modules\Recommendation\Http\Controllers\Admin;

use App\Enums\ChartOptionEnum;
use App\Traits\NepaliDateConverter;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Modules\Recommendation\Entities\PersonalDetail;
use Modules\Recommendation\Entities\RecommendationCategory;
use Modules\Recommendation\Entities\RegistrationDetail;

class DashboardController extends Controller
{
    use NepaliDateConverter;

    protected Collection $registrationDetail;

    public function __construct()
    {
        parent::__construct();
        $this->registrationDetail = RegistrationDetail::get();
    }

    public function index()
    {
        $this->checkAuthorization('recommendationDashboard_access');

        if (request()->ajax()) {
            return [
                'categoryWise' => $this->getCategoryWiseData(),
                'wardWiseRegistration' => $this->getWardWiseData(),
                'monthlyWiseRegistration' => $this->getMonthlyWiseData(),
            ];
        }
        $registrationDetailCount = $this->registrationDetail->count();
        $todayRegistrationDetailCount = RegistrationDetail::whereDate('date_en', today()->toDateString())->count();
        $totalPersonalDetailCount = PersonalDetail::count();
        $totalYealyRegistrationDetailCount = $this->registrationDetail->where('fiscal_year_id', officeSetting()->fiscal_year_id)->count();
        return view('recommendation::admin.dashboard', compact('totalYealyRegistrationDetailCount', 'totalPersonalDetailCount', 'registrationDetailCount', 'todayRegistrationDetailCount'));
    }
    public function ajaxData()
    {
        return [
            'categoryWise' => $this->getCategoryWiseData(),
            'wardWiseRegistration' => $this->getWardWiseData(),
            'monthlyWiseRegistration' => $this->getMonthlyWiseData(),
        ];
    }

    public function getWardWiseData()
    {
        $wardsData = collect();
        foreach (\officeSetting()->localBody->ward_no as $ward) {
            $wardsData->push([
                'ward_no' => "वडा नं. $ward",
                'registration_detail_count' => $this->registrationDetail
                    ->where('fiscal_year_id', \officeSetting()->fiscal_year_id)
                    ->where('ward_no', $ward)
                    ->count()
            ]);
        }

        return [
            'labels' => $wardsData->pluck('ward_no')->toArray(),
            'dataSets' => [
                [
                    'data' => $wardsData->pluck('registration_detail_count')->toArray(),
                    'label' => 'जम्मा',
                    'fill' => 'false',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    public function getCategoryWiseData()
    {
        $recommendationCategories = RecommendationCategory::withCount(['registrationDetails' => function ($query) {
            $query->where('fiscal_year_id', \officeSetting()->fiscal_year_id);
        }])
            ->with(['recommendationCategories' => function ($query) {
                $query->withCount(['registrationDetails' => function ($sub_query) {
                    $sub_query->where('fiscal_year_id', \officeSetting()->fiscal_year_id);
                }]);
            }])->whereNull('recommendation_category_id')->get()->map(function ($recommendationCategory) {
                return [
                    'name' => $recommendationCategory->title . " (" . ($recommendationCategory->registration_details_count + $recommendationCategory->recommendationCategories->sum('registration_details_count')) . ")",
                    'data' => $recommendationCategory->registration_details_count + $recommendationCategory->recommendationCategories->sum('registration_details_count'),
                    'color' => generateRandomRGBAColor() // If you have a function to generate random colors
                ];
            });

        return [
            'labels' => $recommendationCategories->pluck('name')->toArray(),
            'option' => ChartOptionEnum::PIE_CHART->option(),
            'dataSets' => [
                [
                    'data' => $recommendationCategories->pluck('data')->toArray(),
                    'backgroundColor' => $recommendationCategories->pluck('color')->toArray(),
                    'borderColor' => $recommendationCategories->pluck('color')->toArray(),
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    public function getMonthlyWiseData(): array
    {
        $monthlyRegistrations = [];

        foreach ($this->month_name as $key => $month) {
            $monthlyRegistrations[] = $this->registrationDetail->where('fiscal_year_id', \officeSetting()->fiscal_year_id)
                ->where('registration_month', ($key + 1))
                ->count();
        }

        return [
            'labels' => $this->month_name,
            'dataSets' => [
                [
                    'data' => $monthlyRegistrations,
                    'label' => 'जम्मा',
                    'fill' => 'false',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ],
            ],
        ];
    }
}

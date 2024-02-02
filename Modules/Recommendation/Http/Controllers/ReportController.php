<?php

namespace Modules\Recommendation\Http\Controllers;

use App\Models\Settings\FiscalYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use Modules\Recommendation\Entities\RecommendationCategory;
use Modules\Recommendation\Entities\RegistrationDetail;
use Illuminate\Support\Collection;
use Modules\Recommendation\Transformers\Report\RegistrationDetailResource;

class ReportController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('recommendationReport_main');
        $fiscalYears = FiscalYear::all();
        $columnData = $this->getColumns();
        $recommendationCategories = RecommendationCategory::with('recommendationCategories')->whereNull('recommendation_category_id')->get();
        return view('recommendation::admin.reports.index', compact('columnData', 'fiscalYears', 'recommendationCategories'));
    }

    public function report(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'to_date' => ['nullable', 'after_or_equal:from_date'],
            'columns' => ['nullable', 'array']
        ]);

        if (empty($request->input('columns'))) {
            $request->request->add(
                ['columns' =>
                    [
                        'registration_details' => ['recommendation_category_id', 'personal_detail_id', 'fiscal_year_id', 'date_ne']
                    ]
                ]
            );
        }

        $registrationDetails = RegistrationDetail::with('personalDetail', 'fiscalYear', 'recommendationCategory')->where(function ($q) use ($request) {
            $this->filterDataFromUser($q, $request);
        })->get();

        return response()->json([
            'data' => RegistrationDetailResource::collection($registrationDetails)
        ]);
    }

    private function getColumns(): Collection
    {
        $columnData = collect();

        (new RegistrationDetail())
            ->ownAndRelatedModelsFillableColumns()
            ->filter(function ($column) {
                return !array_keys($column, 'printedData');
            })
            ->each(function ($column) use ($columnData) {
                $columnData->push(collect($column)->put('columns', $column['columns']));
            });
        return $columnData;
    }

    private function filterDataFromUser($q, Request $request): void
    {
        if (!empty($request->input('fiscal_year'))) {
            $q->whereIn('fiscal_year_id', $request->input('fiscal_year'));
        }

        if (!empty($request->input('from_date'))) {
            $q->whereDate('date_ne', '>=', $request->input('from_date'));
        }

        if (!empty($request->input('to_date'))) {
            $q->whereDate('date_ne', '<=', $request->input('to_date'));
        }

        if (!empty($request->input('recommendation_category'))) {
            $q->whereIn('recommendation_category_id', $request->input('recommendation_category'));
        }
    }

    public function wardWise()
    {
        $this->checkAuthorization('recommendationReport_ward');
        $fiscalYears = FiscalYear::all();
        $recommendationCategories = RecommendationCategory::with('recommendationCategories')->whereNull('recommendation_category_id')->get();
        return view('recommendation::admin.reports.ward-wise', compact('fiscalYears', 'recommendationCategories'));
    }

    public function wardWiseReport(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'to_date' => ['nullable'],
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')],
            'recommendation_category' => ['nullable', 'array'],
            'recommendation_category.*' => [Rule::exists('recommendation_categories', 'id')],
        ]);

        $recommendationCategories = RecommendationCategory::with(['recommendationCategories.registrationDetails', 'registrationDetails' => function ($query) use ($request) {
            $this->filterDataFromUser($query, $request);
        }])
            ->where(function ($query) use ($request) {
                if (!empty($request->input('recommendation_category'))) {
                    $query->whereIn('id', $request->input('recommendation_category'));
                }
            })->whereNull('recommendation_category_id')
            ->get()->map(function ($recommendationCategory) {
                $wardData = [];
                $total_count = $recommendationCategory->registrationDetails->count();
                foreach (officeSetting()->localBody->ward_no as $ward_no) {
                    $count = 0;
                    $sub_total_count = 0;
                    foreach ($recommendationCategory->recommendationCategories as $subRecommendationCategories) {
                        $sub_total_count += $subRecommendationCategories->registrationDetails->where('ward_no', $ward_no)->count();
                        $count += $subRecommendationCategories->registrationDetails->where('ward_no', $ward_no)->count();
                    }
                    $total_count += $sub_total_count;
                    $wardData[] = $recommendationCategory->registrationDetails->where('ward_no', $ward_no)->count() + $count;
                }
                return [
                    'title' => $recommendationCategory->title,
                    'wards' => $wardData,
                    'total' => $total_count
                ];
            });
        return response()->json([
            'fiscal_years' => FiscalYear::select('title')->whereIn('id', Arr::wrap($request->input('fiscal_year')))->get(),
            'view' => (string)View::make('recommendation::admin.reports.inc.ward-wise', compact('recommendationCategories'))
        ]);
    }


    public function recommendationCategoryWise()
    {
        $this->checkAuthorization('recommendationReport_recommendationCategory');
        $fiscalYears = FiscalYear::all();
        $recommendationCategories = RecommendationCategory::with('recommendationCategories')->whereNull('recommendation_category_id')->get();
        return view('recommendation::admin.reports.recommendation-category-wise', compact('fiscalYears', 'recommendationCategories'));
    }

    public function recommendationCategoryWiseReport(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'to_date' => ['nullable'],
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')],
            'recommendation_category' => ['nullable', 'array'],
            'recommendation_category.*' => [Rule::exists('recommendation_categories', 'id')],
        ]);

        $recommendationCategoryCounts = RecommendationCategory::with(['recommendationCategories.registrationDetails', 'registrationDetails' => function ($query) use ($request) {
            $this->filterDataFromUser($query, $request);
        }])
            ->where(function ($query) use ($request) {
                if (!empty($request->input('recommendation_category'))) {
                    $query->whereIn('id', $request->input('recommendation_category'));
                }
            })->whereNull('recommendation_category_id')
            ->get()->map(function ($recommendationCategory) {
                $total_count = $recommendationCategory->registrationDetails->count();
                $sub_total_count = 0;
                foreach ($recommendationCategory->recommendationCategories as $subRecommendationCategories) {
                    $sub_total_count += $subRecommendationCategories->registrationDetails->count();
                }
                $total_count += $sub_total_count;
                return [
                    'title' => $recommendationCategory->title,
                    'total' => $total_count
                ];
            });

        return response()->json([
            'fiscal_years' => FiscalYear::select('title')->whereIn('id', Arr::wrap($request->input('fiscal_year')))->get(),
            'view' => (string)View::make('recommendation::admin.reports.inc.recommendation-category-wise', compact('recommendationCategoryCounts'))
        ]);
    }

    public function personalDetail()
    {
        $this->checkAuthorization('recommendationReport_personalDetail');
        $fiscalYears = FiscalYear::all();
        $recommendationCategories = RecommendationCategory::with('recommendationCategories')->whereNull('recommendation_category_id')->get();
        return view('recommendation::admin.reports.personal-detail-report', compact('fiscalYears', 'recommendationCategories'));
    }

    public function personalDetailReport(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'to_date' => ['nullable'],
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')],
            'recommendation_category' => ['nullable', 'array'],
            'recommendation_category.*' => [Rule::exists('recommendation_categories', 'id')],
        ]);

        $registrationDetails = RegistrationDetail::with('personalDetail', 'fiscalYear', 'recommendationCategory')
            ->where(function ($q) use ($request) {
                $this->filterDataFromUser($q, $request);
            })
            ->get()
            ->map(function ($registrationDetail, $key) {
                return [
                    'sn' => (int)$key + 1,
                    'name' => $registrationDetail->personalDetail->name ?? '',
                    'category' => $registrationDetail->recommendationCategory->title ?? '',
                    'date' => $registrationDetail->date_ne ?? '',
                ];
            });


        return response()->json([
            'fiscal_years' => !empty($request->input('fiscal_year')) ? FiscalYear::select('title')->whereIn('id', Arr::wrap($request->input('fiscal_year')))->pluck('title') : FiscalYear::pluck('title'),
            'total' => $registrationDetails->count(),
            'data' => $registrationDetails
        ]);
    }
}

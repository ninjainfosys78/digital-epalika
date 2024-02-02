<?php

namespace Modules\TaskManagement\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings\Branch;
use App\Models\Settings\FiscalYear;
use App\Models\User;
use App\Traits\NepaliDateConverter;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\TaskManagement\Entities\Activity;
use Modules\TaskManagement\Enums\ActivityTypeEnum;

class ReportController extends Controller
{
    use NepaliDateConverter;

    public function index()
    {
        $fiscalYears = FiscalYear::get();
        $branches = [];
        $users = [];
        if (checkSuperAdmin()) {
            $branches = Branch::with('branches')->whereNull('branch_id')->get();
            $users = User::all();
        }
        return view('taskmanagement::admin.report.index', compact('fiscalYears', 'branches', 'users'));
    }

    public function report(Request $request)
    {
        $request->validate([
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')->withoutTrashed()],
            'en_from_date' => ['nullable', 'date'],
            'en_to_date' => ['nullable', 'after_or_equal:en_from_date'],
            'branch_id' => ['nullable', 'array'],
            'branch_id.*' => ['nullable', Rule::exists('branches', 'id')->withoutTrashed()],
            'user_id' => ['nullable', 'array'],
            'user_id.*' => ['nullable', Rule::exists('users', 'id')->withoutTrashed()]
        ]);

        $activities = Activity::with('branch', 'user', 'activityLists')
            ->where(function ($q) use ($request) {
                $this->filterDataFromUser($q, $request);
            })
            ->get();

        return response()->json([
            'data' => (string)View::make('taskmanagement::admin.report.inc.reportTable', compact('activities'))
        ]);
    }

    public function filterDataFromUser($q, Request $request): void
    {
        if (!empty($request->input('fiscal_year'))) {
            $q->whereIn('fiscal_year_id', Arr::wrap($request->input('fiscal_year')));
        }
        if (checkSuperAdmin()) {
            if (!empty($request->input('user_id'))) {

                $q->whereIn('user_id', Arr::wrap($request->input('user_id')));
            }
        } else {
            $q->where('user_id', auth()->id());
        }

        if (!empty($request->input('en_date'))) {
            $q->whereDate('date_en', $request->input('en_date'));
        }

        if (!empty($request->input('en_from_date'))) {
            $q->whereDate('date_en', '>=', $request->input('en_from_date'));
        }

        if (!empty($request->input('en_to_date'))) {
            $q->whereDate('date_en', '<=', $request->input('en_to_date'));
        }

        if (!empty($request->input('branch_id'))) {
            $q->whereIn('branch_id', $request->input('branch_id'));
        }
    }

    public function dailyReportPage()
    {

        $branches = [];
        $users = [];
        if (checkSuperAdmin()) {
            $branches = Branch::with('branches')->whereNull('branch_id')->get();
            $users = User::all();
        }
        return view('taskmanagement::admin.report.dailyReport', compact('branches', 'users'));
    }

    public function getDailyReport(Request $request)
    {
        $request->validate([
            'en_date' => ['required', 'date'],
            'branch_id' => ['nullable', 'array'],
            'branch_id.*' => ['nullable', Rule::exists('branches', 'id')->withoutTrashed()],
            'user_id' => ['nullable', 'array'],
            'user_id.*' => ['nullable', Rule::exists('users', 'id')->withoutTrashed()]
        ]);

        $activities = Activity::with('branch', 'user', 'activityLists')
            ->where(function ($q) use ($request) {
                $this->filterDataFromUser($q, $request);
            })
            ->get();

        return response()->json([
            'data' => (string)View::make('taskmanagement::admin.report.inc.reportTable', compact('activities'))
        ]);
    }

    public function monthlyReportPage()
    {
        $fiscalYears = FiscalYear::all();
        $months = $this->month_name;

        $branches = [];
        $users = [];
        if (checkSuperAdmin()) {
            $branches = Branch::with('branches')->whereNull('branch_id')->get();
            $users = User::all();
        }

        return view('taskmanagement::admin.report.monthlyReport', compact('fiscalYears', 'months', 'branches', 'users'));
    }

    public function getMonthlyReport(Request $request)
    {
        $request->validate([
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')->withoutTrashed()],
            'month' => ['required', 'digits_between:1,12'],
            'branch_id' => ['nullable', 'array'],
            'branch_id.*' => ['nullable', Rule::exists('branches', 'id')->withoutTrashed()],
            'user_id' => ['nullable', 'array'],
            'user_id.*' => ['nullable', Rule::exists('users', 'id')->withoutTrashed()],
            'is_month' => ['nullable', 'boolean']
        ]);

        $activities = Activity::with('branch', 'user', 'activityLists')
            ->where(function ($q) use ($request) {
                $this->filterDataFromUser($q, $request);
                if ($request->input('is_month')) {
                    $q->whereNull('date')->where('activity_type', ActivityTypeEnum::MONTHLY->value);
                } else {
                    $q->whereNull('month_range');
                    if (!empty($request->input('month'))) {
                        $q->whereMonth('date', $request->input('month'))->where('activity_type', ActivityTypeEnum::DAILY->value);
                    }
                }
            })
            ->get();

        return response()->json([
            'data' => (string)View::make('taskmanagement::admin.report.inc.reportTable', compact('activities'))
        ]);
    }

    public function quarterlyReportPage()
    {
        $fiscalYears = FiscalYear::all();
        $quarters = $this->quarters();
        $branches = [];
        $users = [];
        if (checkSuperAdmin()) {
            $branches = Branch::with('branches')->whereNull('branch_id')->get();
            $users = User::all();
        }

        return view('taskmanagement::admin.report.quarterlyReport', compact('fiscalYears', 'quarters', 'branches', 'users'));
    }

    public function getQuarterlyReport(Request $request)
    {
        $request->validate([
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')->withoutTrashed()],
            'quarter_value' => ['required', 'digits_between:1,3'],
            'branch_id' => ['nullable', 'array'],
            'branch_id.*' => ['nullable', Rule::exists('branches', 'id')->withoutTrashed()],
            'user_id' => ['nullable', 'array'],
            'user_id.*' => ['nullable', Rule::exists('users', 'id')->withoutTrashed()],
            'is_month' => ['nullable', 'boolean']
        ]);

        $activities = Activity::with('branch', 'user', 'activityLists')
            ->where(function ($q) use ($request) {
                $this->filterDataFromUser($q, $request);
                if ($request->input('is_month')) {
                    $q->whereNull('date')
                        ->where('activity_type', ActivityTypeEnum::QUARTERLY->value)
                        ->where('month_range', $request->input('quarter_value'));
                } else {
                    $q->whereNull('month_range');
                    if (!empty($request->input('quarter_value'))) {
                        $quarter = $this->quarters()->where('quarter_value', $request->input('quarter_value'))->first();
                        $q->whereIn(DB::raw('MONTH(date)'), $quarter['months'])
                            ->where('activity_type', ActivityTypeEnum::DAILY->value);
                    }
                }
            })
            ->get();

        return response()->json([
            'data' => (string)View::make('taskmanagement::admin.report.inc.reportTable', compact('activities'))
        ]);
    }

    public function trimonthlyReportPage()
    {
        $fiscalYears = FiscalYear::all();
        $quarters = $this->triMonthlyQuarters();
        $branches = [];
        $users = [];
        if (checkSuperAdmin()) {
            $branches = Branch::with('branches')->whereNull('branch_id')->get();
            $users = User::all();
        }

        return view('taskmanagement::admin.report.trimonthlyReport', compact('fiscalYears', 'quarters', 'branches', 'users'));
    }

    public function getTrimonthlyReport(Request $request)
    {
        $request->validate([
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')->withoutTrashed()],
            'quarter_value' => ['required', 'digits_between:1,4'],
            'branch_id' => ['nullable', 'array'],
            'branch_id.*' => ['nullable', Rule::exists('branches', 'id')->withoutTrashed()],
            'user_id' => ['nullable', 'array'],
            'user_id.*' => ['nullable', Rule::exists('users', 'id')->withoutTrashed()],
            'is_month' => ['nullable', 'boolean']
        ]);

        $activities = Activity::with('branch', 'user', 'activityLists')
            ->where(function ($q) use ($request) {
                $this->filterDataFromUser($q, $request);
                if ($request->input('is_month')) {
                    $q->whereNull('date')
                        ->where('activity_type', ActivityTypeEnum::TRI_MONTHLY->value)
                        ->where('month_range', $request->input('quarter_value'));
                } else {
                    $q->whereNull('month_range');
                    if (!empty($request->input('quarter_value'))) {
                        $quarter = $this->triMonthlyQuarters()->where('quarter_value', $request->input('quarter_value'))->first();
                        $q->whereIn(DB::raw('MONTH(date)'), $quarter['months'])
                            ->where('activity_type', ActivityTypeEnum::DAILY->value);
                    }
                }
            })
            ->get();

        return response()->json([
            'data' => (string)View::make('taskmanagement::admin.report.inc.reportTable', compact('activities'))
        ]);
    }

    public function yearlyReportPage()
    {
        $fiscalYears = FiscalYear::all();
        $branches = [];
        $users = [];
        if (checkSuperAdmin()) {
            $branches = Branch::with('branches')->whereNull('branch_id')->get();
            $users = User::all();
        }

        return view('taskmanagement::admin.report.yearlyReport', compact('fiscalYears', 'branches', 'users'));
    }

    public function getYearlyReport(Request $request)
    {
        $request->validate([
            'fiscal_year' => ['required', Rule::exists('fiscal_years', 'id')->withoutTrashed()],
            'branch_id' => ['nullable', 'array'],
            'branch_id.*' => ['nullable', Rule::exists('branches', 'id')->withoutTrashed()],
            'user_id' => ['nullable', 'array'],
            'user_id.*' => ['nullable', Rule::exists('users', 'id')->withoutTrashed()],
            'activity_type' => ['required', new Enum(ActivityTypeEnum::class)]
        ]);

        $activities = Activity::with('branch', 'user', 'activityLists')
            ->where('activity_type', $request->input('activity_type'))
            ->where(function ($q) use ($request) {
                $this->filterDataFromUser($q, $request);
            })
            ->orderBy('date')
            ->orderBy('month_range')
            ->get();

        return response()->json([
            'data' => (string)View::make('taskmanagement::admin.report.inc.reportTable', compact('activities'))
        ]);
    }
}

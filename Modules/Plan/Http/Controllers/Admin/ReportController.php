<?php

namespace Modules\Plan\Http\Controllers\Admin;

use App\Models\Settings\FiscalYear;
use App\Traits\NepaliDateConverter;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\Plan\Entities\BudgetHead;
use Modules\Plan\Entities\PlanArea;
use Modules\Plan\Entities\PlanLevel;
use Modules\Plan\Entities\Project;
use Modules\Plan\Enums\ProjectOperatedThroughEnum;
use Modules\Plan\Enums\ProjectStatusEnum;
use Modules\Plan\Transformers\ProjectResource;

class ReportController extends Controller
{
    use NepaliDateConverter;

    public function index()
    {
        $fiscalYears = FiscalYear::get();
        $columnData = $this->getColumns();
        $planAreas = PlanArea::whereNull('plan_area_id')->get();
        $planLevels = PlanLevel::whereNull('plan_level_id')->get();
        $budgetHeads = BudgetHead::whereNull('budget_head_id')->get();

        return view('plan::admin.report.index', compact('fiscalYears', 'columnData', 'planAreas', 'planLevels', 'budgetHeads'));
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
                [
                    'columns' =>
                    [
                        'projects' => ['registration_no', 'project_name', 'project_start_date', 'project_completion_date', 'allocated_amount']
                    ]
                ]
            );
        }

        $projects = Project::with('fiscalYear', 'budgetHead', 'planArea', 'planLevel')->where(function ($q) use ($request) {
            $this->filterDataFromUser($q, $request);
        })->get();

        if (!empty($request->input('columns')['project_grant_details'])) {
            $projects->load('projectGrantDetails');
        }

        if (!empty($request->input('columns')['benefited_member_details'])) {
            $projects->load('benefitedMemberDetails');
        }

        return response()->json([
            'data' => ProjectResource::collection($projects)
        ]);
    }

    private function getColumns(): Collection
    {
        $columnData = collect();

        (new Project())
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
            $q->whereDate('project_start_date', '>=', $request->input('from_date'));
        }

        if (!empty($request->input('to_date'))) {
            $q->whereDate('project_start_date', '<=', $request->input('to_date'));
        }

        if (!empty($request->input('plan_sub_area_id'))) {
            $q->whereIn('plan_area_id', $request->input('plan_sub_area_id'));
        }

        if (!empty($request->input('plan_sub_level_id'))) {
            $q->whereIn('plan_level_id', $request->input('plan_sub_level_id'));
        }

        if (!empty($request->input('budget_sub_head_id'))) {
            $q->whereIn('budget_head_id', $request->input('budget_sub_head_id'));
        }

        if (!empty($request->input('project_status'))) {
            $q->where('project_status', $request->input('project_status'));
        }
    }

    public function annualProgressReport()
    {
        $fiscalYears = FiscalYear::get();
        $planAreas = PlanArea::whereNull('plan_area_id')->get();
        $planLevels = PlanLevel::whereNull('plan_level_id')->get();
        $budgetHeads = BudgetHead::whereNull('budget_head_id')->get();

        return view('plan::admin.report.annual-progress-report', compact('fiscalYears', 'planAreas', 'planLevels', 'budgetHeads'));
    }

    public function getAnnualProgressReport(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'en_from_date' => ['nullable'],
            'to_date' => ['nullable'],
            'en_to_date' => ['nullable'],
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')],
            'ward_no' => ['nullable', 'array'],
            'plan_area_id' => ['nullable', 'array'],
            'plan_area_id.*' => [Rule::exists('plan_areas', 'id')],
            'plan_sub_area_id' => ['nullable', 'array'],
            'plan_sub_area_id.*' => [Rule::exists('plan_areas', 'id')],
            'plan_level_id' => ['nullable', 'array'],
            'plan_level_id.*' => [Rule::exists('plan_levels', 'id')],
            'plan_sub_level_id' => ['nullable', 'array'],
            'plan_sub_level_id.*' => [Rule::exists('plan_levels', 'id')],
            'budget_head_id' => ['nullable', 'array'],
            'budget_head_id.*' => [Rule::exists('budget_heads', 'id')],
            'budget_sub_head_id' => ['nullable', 'array'],
            'budget_sub_head_id.*' => [Rule::exists('budget_heads', 'id')],
            'project_status' => ['nullable', 'array'],
            'project_status.*' => [new Enum(ProjectStatusEnum::class)],
        ]);

        $projects = Project::where(function ($q) use ($request) {
            $this->filterDataFromUser($q, $request);
        })->get()
            ->filter(function ($project) use ($request) {
                if (!empty($request->input('ward_no'))) {
                    return count(array_intersect($request->input('ward_no'), $project->ward_no)) > 0;
                }
                return true;
            })
            ->map(function ($project, $key) {
                return [
                    'sn' => (int)$key + 1,
                    'project_name' => $project->project_name ?? '',
                    'unit' => $project->physical_progress_unit ?? '',
                    'total_quantity' => 1.00,
                    'total_amount' => $project->total_cost_estimate_amount ?? 0.00,
                    'total_load' => 100.00,
                    'last_year_completed_quantity' => '',
                    'last_year_expense' => '',
                    'last_year_weighted_progress' => '',
                    'this_year_target_size' => $project->total_cost_estimate_amount ?? 0.00,
                    'this_year_progress' => $project->total_cost_estimate_amount > 0 ? round(($project->progress_spent_amount / $project->total_cost_estimate_amount) * 100, 2) : 0.00,
                    'this_year_estimate_expense' => $project->progress_spent_amount ?? 0.00,
                    'yearly_quantity' => 1.00,
                    'yearly_load' => 100.00,
                    'yearly_budget' => $project->total_cost_estimate_amount ?? 0.00,
                    'first_quantity' => $project->total_cost_estimate_amount > 0 ? round(($project->first_quarterly_amount / $project->total_cost_estimate_amount), 2) : 0.00,
                    'first_load' => $project->total_cost_estimate_amount > 0 ? round(($project->first_quarterly_amount / $project->total_cost_estimate_amount) * 100, 2) : 0.00,
                    'first_budget' => $project->first_quarterly_amount ?? 0.00,
                    'second_quantity' => $project->total_cost_estimate_amount > 0 ? round(($project->second_quarterly_amount / $project->total_cost_estimate_amount), 2) : 0.00,
                    'second_load' => $project->total_cost_estimate_amount > 0 ? round(($project->second_quarterly_amount / $project->total_cost_estimate_amount) * 100, 2) : 0.00,
                    'second_budget' => $project->second_quarterly_amount ?? 0.00,
                    'third_quantity' => $project->total_cost_estimate_amount > 0 ? round(($project->third_quarterly_amount / $project->total_cost_estimate_amount), 2) : 0.00,
                    'third_load' => $project->total_cost_estimate_amount > 0 ? round(($project->third_quarterly_amount / $project->total_cost_estimate_amount) * 100, 2) : 0.00,
                    'third_budget' => $project->third_quarterly_amount ?? 0.00,
                    'remarks' => $project->remarks ?? ''
                ];
            });

        return response()->json([
            'data' => $projects
        ]);
    }

    public function consumerCommitteeProjectsPage()
    {
        $fiscalYears = FiscalYear::get();
        $planAreas = PlanArea::whereNull('plan_area_id')->get();
        $planLevels = PlanLevel::whereNull('plan_level_id')->get();
        $budgetHeads = BudgetHead::whereNull('budget_head_id')->get();

        return view('plan::admin.report.consumer_committee_projects', compact('fiscalYears', 'planAreas', 'planLevels', 'budgetHeads'));
    }

    public function getConsumerCommitteeProjects(Request $request)
    {
        $projects = Project::with('consumerCommittee')->where(function ($q) use ($request) {
            $q->where('operated_through', ProjectOperatedThroughEnum::CONSUMER_COMMITTEE);
            $this->filterDataFromUser($q, $request);
        })->get()
            ->filter(function ($project) use ($request) {
                if (!empty($request->input('ward_no'))) {
                    return count(array_intersect($request->input('ward_no'), $project->ward_no)) > 0;
                }
                return true;
            })
            ->map(function ($project, $key) {
                return [
                    'sn' => (int)$key + 1,
                    'consumer_committee_name' => $project->consumerCommittee->name ?? '',
                    'project_name' => $project->project_name ?? '',
                    'total_amount_for_contingency' => $project->total_amount_for_contingency ?? 0.00,
                    'project_contract_number' => $project->project_contract_amount ?? 0.00,
                    'project_contract_amount' => $project->project_contract_amount ?? 0.00,
                    'labor_amount' => $project->labor_amount ?? 0.00,
                    'total_amount' => $project->total_cost_estimate_amount ?? 0.00,
                    'project_start_date' => $project->project_start_date ?? '',
                    'project_completion_date' => $project->project_completion_date ?? '',
                    'project_status' => $project->project_status?->label()
                ];
            });

        return response()->json([
            'data' => $projects
        ]);
    }

    public function contractProjectsPage()
    {
        $fiscalYears = FiscalYear::get();
        $planAreas = PlanArea::whereNull('plan_area_id')->get();
        $planLevels = PlanLevel::whereNull('plan_level_id')->get();
        $budgetHeads = BudgetHead::whereNull('budget_head_id')->get();

        return view('plan::admin.report.contract_projects', compact('fiscalYears', 'planLevels', 'planAreas', 'budgetHeads'));
    }

    public function getContractProjects(Request $request)
    {
        $projects = Project::with('projectBidDetail', 'projectDeadlineExtensions')
            ->withSum(['projectBidSubmissions as current_year_expenses_amount' => function ($query) {
                $query->where('fiscal_year_id', officeSetting()->fiscal_year_id);
            }], 'amount')
            ->withSum('projectBidSubmissions', 'amount')
            ->where(function ($q) use ($request) {
                $q->whereNot('operated_through', ProjectOperatedThroughEnum::CONSUMER_COMMITTEE);
                $this->filterDataFromUser($q, $request);
            })->get()
            ->filter(function ($project) use ($request) {
                if (!empty($request->input('ward_no'))) {
                    return count(array_intersect($request->input('ward_no'), $project->ward_no)) > 0;
                }
                return true;
            })
            ->map(function ($project, $key) {
                return [
                    'sn' => (int)$key + 1,
                    'bid_no' => $project->projectBidDetail->bid_no ?? '',
                    'contractor_name' => $project->projectBidDetail->contractor_name ?? '',
                    'project_name' => $project->project_name ?? '',
                    'contract_no' => 0.00,
                    'project_contract_amount' => $project->project_contract_amount ?? 0.00,
                    'project_start_date' => $project->project_start_date ?? '',
                    'project_completion_date' => $project->project_completion_date ?? '',
                    'project_status' => $project->project_status?->label(),
                    'project_deadline_extensions_count' => $project->projectDeadlineExtensions->count(),
                    'project_deadline_extended_months' => $project->projectDeadlineExtensions->sum('extended_months'),
                    'variation_percentage' => 0.00,
                    'variation_amount' => 0.00,
                    'price_adjustment_including_vat' => 0.00,
                    'expiry_date_of_performance' => null,
                    'insurance_expiry_date' => $project->projectBidDetail->insurance_expiry_date ?? null,
                    'current_year_expenses_amount' => $project->current_year_expenses_amount ?? 0.00,
                    'total_expenses_amount' => $project->project_bid_submissions_sum_amount ?? 0.00,
                    'age_built_map_submitted' => null
                ];
            });

        return response()->json([
            'data' => $projects
        ]);
    }

    public function incompleteProjectsPage()
    {
        $fiscalYears = FiscalYear::get();
        $planAreas = PlanArea::whereNull('plan_area_id')->get();
        $planLevels = PlanLevel::whereNull('plan_level_id')->get();
        $budgetHeads = BudgetHead::whereNull('budget_head_id')->get();

        return view('plan::admin.report.incomplete_projects', compact('fiscalYears', 'planLevels', 'planAreas', 'budgetHeads'));
    }

    public function getIncompleteProjects(Request $request)
    {
        $projects = Project::with('consumerCommittee', 'projectBidDetail')
            ->withSum('projectBidSubmissions', 'amount')
            ->withSum('consumerCommitteeTransactions', 'amount')
            ->where(function ($q) use ($request) {
                $q->where('project_status', ProjectStatusEnum::IN_PROGRESS);
                $q->whereDate('project_completion_date', '>', $this->get_today_nepali_date());
                $this->filterDataFromUser($q, $request);
            })->get()
            ->filter(function ($project) use ($request) {
                if (!empty($request->input('ward_no'))) {
                    return count(array_intersect($request->input('ward_no'), $project->ward_no)) > 0;
                }
                return true;
            })
            ->map(function ($project, $key) {
                return [
                    'sn' => (int)$key + 1,
                    'project_name' => $project->project_name ?? '',
                    'builder' => $project->operated_through == ProjectOperatedThroughEnum::CONSUMER_COMMITTEE ? $project->consumerCommittee->name ?? '' : $project->projectBidDetail->contractor_name ?? '',
                    'contract_date' => $project->contract_date,
                    'project_completion_date' => $project->project_completion_date ?? '',
                    'total_expenses_amount' => $project->operated_through == ProjectOperatedThroughEnum::CONSUMER_COMMITTEE ? $project->consumer_committee_transactions_sum_amount : $project->project_bid_submissions_sum_amount,
                    'physical_progress' => "$project->physical_progress_completed  $project->physical_progress_unit"
                ];
            });

        return response()->json([
            'data' => $projects
        ]);
    }

    public function priceRangeReportPage()
    {
        $fiscalYears = FiscalYear::get();
        $planAreas = PlanArea::whereNull('plan_area_id')->get();
        $planLevels = PlanLevel::whereNull('plan_level_id')->get();
        $budgetHeads = BudgetHead::whereNull('budget_head_id')->get();

        return view('plan::admin.report.price_range_report', compact('fiscalYears', 'planLevels', 'planAreas', 'budgetHeads'));
    }

    public function getPriceRangeReportData(Request $request)
    {
        $range = collect([
            'below_1_lakh' => 0,
            '1_lakh_to_2_lakh' => 0,
            '2_lakh_to_5_lakh' => 0,
            '5_lakh_to_10_lakh' => 0,
            '10_lakh_to_50_lakh' => 0,
            'more_than_50_lakh' => 0,
            'total' => 0,
        ]);
        DB::table('projects')
            ->select('allocated_amount')
            ->where('deleted_at', null)
            ->where(function ($query) use ($request) {
                $this->filterDataFromUser($query, $request);
            })
            ->get()
            ->each(function ($project) use ($range) {
                $range['total'] += 1;

                if ($project->allocated_amount < 100000) {
                    $range['below_1_lakh'] += 1;
                }
                if ($project->allocated_amount >= 100000 && $project->allocated_amount < 200000) {
                    $range['1_lakh_to_2_lakh'] += 1;
                }
                if ($project->allocated_amount >= 200000 && $project->allocated_amount < 500000) {
                    $range['2_lakh_to_5_lakh'] += 1;
                }
                if ($project->allocated_amount >= 500000 && $project->allocated_amount < 1000000) {
                    $range['5_lakh_to_10_lakh'] += 1;
                }
                if ($project->allocated_amount >= 1000000 && $project->allocated_amount < 5000000) {
                    $range['10_lakh_to_50_lakh'] += 1;
                }
                if ($project->allocated_amount >= 5000000) {
                    $range['more_than_50_lakh'] += 1;
                }
            });
        return $range;
    }

    public function workDetailReportPage()
    {
        $fiscalYears = FiscalYear::get();
        $planAreas = PlanArea::whereNull('plan_area_id')->get();
        $planLevels = PlanLevel::whereNull('plan_level_id')->get();
        $budgetHeads = BudgetHead::whereNull('budget_head_id')->get();

        return view('plan::admin.report.work_detail_report', compact('fiscalYears', 'planLevels', 'planAreas', 'budgetHeads'));
    }

    public function getWorkDetailReport(Request $request)
    {
        $projects = Project::withSum('projectBidSubmissions', 'amount')
            ->withSum('consumerCommitteeTransactions', 'amount')
            ->where(function ($q) use ($request) {
                $this->filterDataFromUser($q, $request);
            })->get()
            ->filter(function ($project) use ($request) {
                if (!empty($request->input('ward_no'))) {
                    return count(array_intersect($request->input('ward_no'), $project->ward_no)) > 0;
                }
                return true;
            })
            ->map(function ($project, $key) {
                return [
                    'sn' => (int)$key + 1,
                    'project_name' => $project->project_name ?? 0.00,
                    'total_expenses_amount' => $project->operated_through == ProjectOperatedThroughEnum::CONSUMER_COMMITTEE ? $project->consumer_committee_transactions_sum_amount : $project->project_bid_submissions_sum_amount,
                    'from_consumer_committee_count' => $project->operated_through == ProjectOperatedThroughEnum::CONSUMER_COMMITTEE ? 1 : '',
                    'from_consumer_committee_amount' => $project->operated_through == ProjectOperatedThroughEnum::CONSUMER_COMMITTEE ? $project->consumer_committee_transactions_sum_amount : '',
                    'from_contract_count' => $project->operated_through != ProjectOperatedThroughEnum::CONSUMER_COMMITTEE ? 1 : '',
                    'from_contract_amount' => $project->operated_through != ProjectOperatedThroughEnum::CONSUMER_COMMITTEE ? $project->project_bid_submissions_sum_amount : '',
                ];
            });

        return response()->json([
            'data' => $projects
        ]);
    }
}

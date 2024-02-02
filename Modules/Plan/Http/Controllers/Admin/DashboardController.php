<?php

namespace Modules\Plan\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Modules\Plan\Entities\BudgetHead;
use Modules\Plan\Entities\PlanArea;
use Modules\Plan\Entities\PlanLevel;
use Modules\Plan\Entities\Project;
use Modules\Plan\Enums\ProjectStatusEnum;

class DashboardController extends Controller
{
    protected Collection $projects;

    public function __construct()
    {
        parent::__construct();

        $this->projects = Project::where('fiscal_year_id', \officeSetting()->fiscal_year_id)->get();
    }

    public function index()
    {
        $this->checkAuthorization('planDashboard_access');

        $not_started_project_count = $this->projects->where('project_status', ProjectStatusEnum::NOT_STARTED)->count();
        $in_progress_project_count = $this->projects->where('project_status', ProjectStatusEnum::IN_PROGRESS)->count();
        $completed_project_count = $this->projects->where('project_status', ProjectStatusEnum::COMPLETED)->count();
        $deadline_extended_project_count = Project::whereHas('projectDeadlineExtensions')->count();

        return view('plan::admin.dashboard', compact(
            'not_started_project_count',
            'in_progress_project_count',
            'deadline_extended_project_count',
            'completed_project_count'
        ));
    }
    public function ajaxData()
    {
        return [
            'budgetHeadWiseProjects' => $this->getBudgetHeadWiseProjects(),
            'wardWiseProjects' => $this->getWardWiseProjects(),
            'planLevelWiseProjects' => $this->getPlanLevelWiseProjects(),
            'planAreaWiseProjects' => $this->getPlanAreaWiseProjects()
        ];
    }

    public function getWardWiseProjects()
    {
        $wardsData = collect();

        foreach (\officeSetting()->localBody->ward_no as $ward) {
            $wardsData->push([
                'ward_no' => "वार्ड नं. $ward",
                'projects_count' => $this
                    ->projects
                    ->filter(function ($project) use ($ward) {
                        return in_array($ward, $project->ward_no);
                    })
                    ->count()
            ]);
        }

        return [
            'labels' => $wardsData->pluck('ward_no')->toArray(),
            'dataSets' => [
                [
                    'data' => $wardsData->pluck('projects_count')->toArray(),
                    'label' => 'जम्मा',
                ],
            ],
        ];
    }

    private function getPlanAreaWiseProjects()
    {
        $planAreas = PlanArea::withCount(['projects' => function ($query) {
            $query->where('fiscal_year_id', \officeSetting()->fiscal_year_id);
        }])
            ->with(['planAreas' => function ($query) {
                $query->withCount(['projects' => function ($sub_query) {
                    $sub_query->where('fiscal_year_id', \officeSetting()->fiscal_year_id);
                }]);
            }])->whereNull('plan_area_id')->get()->map(function ($planArea) {
                return [
                    'area_name' => $planArea->area_name,
                    'projects_count' => $planArea->projects_count + $planArea->planAreas->sum('projects_count')
                ];
            });

        return [
            'labels' => $planAreas->pluck('area_name')->toArray(),
            'dataSets' => [
                [
                    'data' => $planAreas->pluck('projects_count')->toArray(),
                    'label' => 'शुरु नभएका योजनाहरु ',
                    'fill' => 'false',
                ],
                [
                    'data' => $planAreas->pluck('projects_count')->toArray(),
                    'label' => 'चालु योजनाहरु',
                    'fill' => 'false',
                ],
                [
                    'data' => $planAreas->pluck('projects_count')->toArray(),
                    'label' => 'सम्पन्न योजनाहरू',
                    'fill' => 'false',
                ],
            ],

        ];
    }

    public function getBudgetHeadWiseProjects()
    {
        return BudgetHead::withCount(['projects' => function ($query) {
            $query->where('fiscal_year_id', \officeSetting()->fiscal_year_id);
        }])
            ->with(['budgetHeads' => function ($query) {
                $query->withCount(['projects' => function ($sub_query) {
                    $sub_query->where('fiscal_year_id', \officeSetting()->fiscal_year_id);
                }]);
            }])
            ->whereNull('budget_head_id')
            ->get()
            ->map(function ($budgetHead) {
                return [
                    'name' => $budgetHead->title,
                    'data' => $budgetHead->projects_count + $budgetHead->budgetHeads->sum('projects_count')
                ];
            });
    }

    private function getPlanLevelWiseProjects()
    {
        $planLevels = PlanLevel::withCount(['projects' => function ($query) {
            $query->where('fiscal_year_id', \officeSetting()->fiscal_year_id);
        }])
            ->with(['planLevels' => function ($query) {
                $query->withCount(['projects' => function ($sub_query) {
                    $sub_query->where('fiscal_year_id', \officeSetting()->fiscal_year_id);
                }]);
            }])->whereNull('plan_level_id')->get()->map(function ($planLevel) {
                return [
                    'name' => $planLevel->level_name,
                    'data' => $planLevel->projects_count + $planLevel->planLevels->sum('projects_count')
                ];
            });

        return $planLevels;
    }
}

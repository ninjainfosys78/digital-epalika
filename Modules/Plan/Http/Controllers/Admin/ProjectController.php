<?php

namespace Modules\Plan\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Modules\Plan\Entities\BudgetHead;
use Modules\Plan\Entities\ExpenseHead;
use Modules\Plan\Entities\PlanArea;
use Modules\Plan\Entities\PlanLevel;
use Modules\Plan\Entities\PlanTemplate;
use Modules\Plan\Entities\Project;
use Modules\Plan\Entities\ProjectAllocatedAmount;
use Modules\Plan\Enums\PlanTemplateTypeEnum;
use Modules\Plan\Enums\ProjectStatusEnum;
use Modules\Plan\Http\Requests\Project\StoreProjectRequest;
use Modules\Plan\Http\Requests\Project\UpdateProjectRequest;

class ProjectController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('project_access');

        $projects = Project::with('planArea')->withSum('projectAllocatedAmounts', 'amount')->where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['registration_no', 'project_name'], request('search'));
            }
            if (!empty(request('from_date'))) {
                $q->whereDate('project_start_date', '>=', request('from_date'));
            }
            if (!empty(request('to_date'))) {
                $q->whereDate('project_start_date', '<=', request('to_date'));
            }
            if (!empty(request('project_status'))) {
                $q->where('project_status', request('project_status'));
            }
            if (!empty(request('expense_head_id'))) {
                $q->where('expense_head_id', request('expense_head_id'));
            }
            if (!is_null(request('is_contracted'))) {
                $q->where('is_contracted', request('is_contracted'));
            }
        })
            ->latest()->paginate(10);
        $expenseHeads = ExpenseHead::all();


        return view('plan::admin.project.index', compact('projects', 'expenseHeads'));
    }

    public function create()
    {
        $this->checkAuthorization('project_create');

        $planAreas = PlanArea::with('planAreas')->whereNull('plan_area_id')->get();
        $planLevels = PlanLevel::with('planLevels')->whereNull('plan_level_id')->get();
        $budgetHeads = BudgetHead::with('budgetHeads')->whereNull('budget_head_id')->get();
        $expenseHeads = ExpenseHead::all();
        $registration_no = "PP-" . (\officeSetting()->fiscalYear->title ?? '') . '-' . Str::padLeft(Project::max('id') + 1, 3, 0);

        return view('plan::admin.project.create', compact('planAreas', 'planLevels', 'budgetHeads', 'expenseHeads', 'registration_no'));
    }

    public function store(StoreProjectRequest $request)
    {
        $this->checkAuthorization('project_create');


        DB::transaction(function () use ($request) {
            $project = Project::create($request->validated() + [
                    'fiscal_year_id' => \officeSetting()->fiscal_year_id ?? '',
                    'project_status' => ProjectStatusEnum::NOT_STARTED ?? ''
                ]);

            foreach ($request->input('projectAllocatedAmounts') as $projectAllocatedAmount) {
                $project->projectAllocatedAmounts()->create($projectAllocatedAmount);
            }
        });

        toast('योजना/कार्यक्रम सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(Project $project)
    {
        $this->checkAuthorization('project_access');

        $project->load('projectBidDetail', 'projectAgreementTerm', 'projectMaintenanceArrangement', 'projectBidSubmissions', 'planArea', 'planLevel', 'consumerCommittee.consumerCommitteeOfficials', 'budgetHead', 'projectGrantDetails', 'benefitedMemberDetails', 'projectAgreementTerm', 'projectDocuments', 'files', 'consumerCommitteeTransactions', 'technicalCostEstimates.unit', 'projectAllocatedAmounts.budgetHead');

        if (request()->ajax()) {
            return response()->json([
                'view' => (string)View::make('plan::admin.project.detail', compact('project'))
            ]);
        }

        return view('plan::admin.project.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->checkAuthorization('project_edit');

        $project->load('projectAllocatedAmounts.budgetHead');

        $planAreas = PlanArea::with('planAreas')->whereNull('plan_area_id')->get();
        $planLevels = PlanLevel::with('planLevels')->whereNull('plan_level_id')->get();
        $budgetHeads = BudgetHead::with('budgetHeads')->whereNull('budget_head_id')->get();
        $expenseHeads = ExpenseHead::all();

        return view('plan::admin.project.edit', compact('project', 'planAreas', 'planLevels', 'budgetHeads', 'expenseHeads'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->checkAuthorization('project_edit');
        DB::transaction(function () use ($request, $project) {
            $project->update($request->validated());

            foreach ($request->input('projectAllocatedAmounts') as $projectAllocatedAmount) {
                ProjectAllocatedAmount::updateOrCreate(
                    ['project_id' => $project->id, 'id' => $projectAllocatedAmount['id'] ?? ''],
                    $projectAllocatedAmount
                );
            }
            $project->projectAllocatedAmounts()->whereNotIn('id', Arr::pluck($request->input('projectAllocatedAmounts'), 'id'))->delete();
        });

        toast('परियोजना सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.plan.project.index'));
    }

    public function destroy(Project $project)
    {
        $this->checkAuthorization('project_delete');
    }

    public function fileList(Project $project)
    {
        $project->load('files');

        return view('plan::admin.project.file_list', compact('project'));
    }

    public function uploadFilePage(Project $project)
    {
        return view('plan::admin.project.upload_files', compact('project'));
    }

    public function uploadFile(Request $request, Project $project)
    {
        $formData = $request->validate([
            'file_name' => ['nullable'],
            'files' => ['required', 'array'],
            'file.*' => ['mimes:jpg,png,jpeg,pdf']
        ]);

        foreach ($request->file('files') as $file) {
            $project->files()->create([
                'file_name' => $formData['file_name'] ?: pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'extension' => $file->getClientOriginalExtension(),
                'file' => $file->store('plan/project_files', 'public')
            ]);
        }

        toast('फाइल सफलतापूर्वक अपलोड गरियो', 'success');

        return redirect(route('admin.plan.project.fileList', $project));
    }

    public function print(Request $request, Project $project, PlanTemplateTypeEnum $planTemplateTypeEnum)
    {
        if ($request->ajax()) {
            return response()->json([
                'data' => $project->getSpecificTemplateData($planTemplateTypeEnum)
            ]);
        }
    }

    public function templateData(Request $request, Project $project, PlanTemplate $planTemplate)
    {
        if ($request->ajax()) {
            return response()->json([
                'data' => $project->getPlanTemplateData($planTemplate)
            ]);
        }
    }
}

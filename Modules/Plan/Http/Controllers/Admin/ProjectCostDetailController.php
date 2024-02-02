<?php

namespace Modules\Plan\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Plan\Entities\Project;

class ProjectCostDetailController extends Controller
{
    public function index(Project $project)
    {
        $project->loadSum('projectAllocatedAmounts', 'amount');

        return view('plan::admin.project_cost_detail.index', compact('project'));
    }
}

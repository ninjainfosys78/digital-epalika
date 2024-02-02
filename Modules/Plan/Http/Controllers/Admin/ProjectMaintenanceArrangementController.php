<?php

namespace Modules\Plan\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Plan\Entities\Project;
use Modules\Plan\Entities\ProjectMaintenanceArrangement;

class ProjectMaintenanceArrangementController extends Controller
{
    public function index(Project $project)
    {
        if (!$project->projectMaintenanceArrangement) {
            return redirect(route('admin.plan.project.projectMaintenanceArrangement.create', $project));
        }

        return view('plan::admin.maintenance_arrangement.index', compact('project'));
    }

    public function create(Project $project)
    {
        $project->load('projectMaintenanceArrangement');

        return view('plan::admin.maintenance_arrangement.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'office_name' => ['required'],
            'public_service' => ['nullable', 'numeric'],
            'service_fee' => ['nullable', 'numeric'],
            'from_fee_donation' => ['nullable', 'numeric'],
            'others' => ['nullable', 'numeric']
        ]);

        ProjectMaintenanceArrangement::updateOrCreate(
            ['project_id' => $project->id],
            [
                'office_name' => $request->input('office_name'),
                'public_service' => $request->input('public_service') ?? 0,
                'service_fee' => $request->input('service_fee') ?? 0,
                'from_fee_donation' => $request->input('from_fee_donation') ?? 0,
                'others' => $request->input('others') ?? 0
            ]
        );

        toast('डाटा सफलतापूर्वक अपडेट गरियो', 'success');

        return redirect(route('admin.plan.project.projectMaintenanceArrangement.index', $project));
    }
}

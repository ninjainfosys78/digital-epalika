<?php

namespace Modules\Plan\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Plan\Entities\Project;
use Modules\Plan\Entities\ProjectDeadlineExtension;
use Modules\Plan\Http\Requests\ProjectDeadlineExtension\StoreProjectDeadlineExtensionRequest;
use Modules\Plan\Http\Requests\ProjectDeadlineExtension\UpdateProjectDeadlineExtensionRequest;

class ProjectDeadlineExtensionController extends Controller
{
    public function index(Project $project)
    {
        $this->checkAuthorization('projectDeadlineExtension_access');

        $project->load('projectDeadlineExtensions');

        return view('plan::admin.project_deadline_extension.index', compact('project'));
    }

    public function create(Project $project)
    {
        $this->checkAuthorization('projectDeadlineExtension_create');

        return view('plan::admin.project_deadline_extension.create', compact('project'));
    }

    public function store(StoreProjectDeadlineExtensionRequest $request, Project $project)
    {
        $this->checkAuthorization('projectDeadlineExtension_create');

        $project->projectDeadlineExtensions()->create($request->validated());

        toast('म्याद सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(Project $project, ProjectDeadlineExtension $projectDeadlineExtension)
    {
        $this->checkAuthorization('projectDeadlineExtension_access');

        return view('plan::show');
    }

    public function edit(Project $project, ProjectDeadlineExtension $projectDeadlineExtension)
    {
        $this->checkAuthorization('projectDeadlineExtension_edit');

        return view('plan::admin.project_deadline_extension.edit', compact('project', 'projectDeadlineExtension'));
    }

    public function update(UpdateProjectDeadlineExtensionRequest $request, Project $project, ProjectDeadlineExtension $projectDeadlineExtension)
    {
        $this->checkAuthorization('projectDeadlineExtension_edit');

        $projectDeadlineExtension->update($request->validated());

        toast('म्याद थप विवरण सफलतापूर्वक अपडेट गरियो', 'success');
        return redirect(route('admin.plan.project.projectDeadlineExtension.index', $project));
    }

    public function destroy(Project $project, ProjectDeadlineExtension $projectDeadlineExtension)
    {
        $this->checkAuthorization('projectDeadlineExtension_delete');

        $projectDeadlineExtension->delete();

        toast('म्याद थप सफलतापूर्वक हटाइयो', 'success');
        return back();
    }
}

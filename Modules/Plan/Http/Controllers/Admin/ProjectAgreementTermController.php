<?php

namespace Modules\Plan\Http\Controllers\Admin;

use App\Traits\NepaliDateConverter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Modules\Plan\Entities\Project;
use Modules\Plan\Entities\ProjectAgreementTerm;

class ProjectAgreementTermController extends Controller
{
    use NepaliDateConverter;

    public function index(Project $project)
    {
        return view('plan::index');
    }

    public function create(Project $project)
    {
        $project->load('projectAgreementTerm');

        $today_date = $this->get_today_nepali_date();
        $agreementTermTemplate = (string)View::make('plan::admin.setting.template.agreement_term_template', compact('project', 'today_date'));
        $project->load('projectAgreementTerm');

        return view('plan::admin.agreement_term.create', compact('project', 'agreementTermTemplate'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'data' => ['required']
        ]);

        ProjectAgreementTerm::updateOrCreate(
            ['project_id' => $project->id],
            [
                'data' => $request->input('data')
            ]
        );

        toast('सम्झौता शर्त सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    public function show($id)
    {
        return view('plan::show');
    }

    public function edit($id)
    {
        return view('plan::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

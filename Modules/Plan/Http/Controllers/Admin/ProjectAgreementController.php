<?php

namespace Modules\Plan\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Plan\Entities\ConsumerCommittee;
use Modules\Plan\Entities\ConsumerCommitteeOfficial;
use Modules\Plan\Entities\Project;
use Modules\Plan\Entities\ProjectBidDetail;
use Modules\Plan\Enums\ProjectStatusEnum;
use Modules\Plan\Http\Requests\ProjectAgreement\ConsumerCommitteeRequest;
use Modules\Plan\Http\Requests\ProjectAgreement\ProjectBidDetailRequest;

class ProjectAgreementController extends Controller
{
    public function index(Project $project)
    {
        return view('plan::admin.project_agreement.index', compact('project'));
    }

    public function storeConsumerCommittee(ConsumerCommitteeRequest $request, Project $project)
    {
        DB::transaction(function () use ($project, $request) {
            $project->update([
                'operated_through' => $request->input('operated_through'),
                'is_contracted' => 1,
                'project_status' => ProjectStatusEnum::IN_PROGRESS,
                'contract_date' => $request->input('contract_date'),
                'project_start_date' => $request->input('project_start_date'),
                'project_completion_date' => $request->input('project_completion_date')
            ]);

            $consumerCommittee = ConsumerCommittee::updateOrCreate(
                ['project_id' => $project->id],
                [
                    'name' => $request->input('name'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'formation_date' => $request->input('formation_date'),
                    'committee_registration_date' => $request->input('committee_registration_date'),
                    'meeting_date' => $request->input('meeting_date'),
                    'registration_no' => $request->input('registration_no'),
                    'beneficiary_no' => $request->input('beneficiary_no'),
                    'experience_in_project' => $request->input('experience_in_project')
                ]
            );
            foreach ($request->input('consumerCommitteeOfficials') as $consumerCommitteeOfficial) {
                ConsumerCommitteeOfficial::updateOrCreate(
                    ['consumer_committee_id' => $consumerCommittee->id, 'id' => $consumerCommitteeOfficial['id'] ?? null],
                    $consumerCommitteeOfficial
                );
            }
            $project->consumerCommittee?->consumerCommitteeOfficials()->whereNotIn('id', Arr::pluck($request->input('consumerCommitteeOfficials'), 'id'))->delete();
        });

        toast('उपभोक्ता समिति सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.plan.project.index'));
    }

    public function storeProjectBidDetail(ProjectBidDetailRequest $request, Project $project)
    {
        DB::transaction(function () use ($project, $request) {
            ProjectBidDetail::updateOrCreate(
                ['project_id' => $project->id],
                $request->validated()
            );

            $project->update([
                'is_contracted' => 1,
                'operated_through' => $request->input('operated_through'),
                'project_status' => ProjectStatusEnum::IN_PROGRESS,
                'contract_date' => $request->input('contract_date') ?? null,
                'project_start_date' => $request->input('project_start_date') ?? null,
                'project_completion_date' => $request->input('project_completion_date') ?? null,
            ]);
        });

        toast('बोलपत्र विवरण सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.plan.project.index'));
    }
}

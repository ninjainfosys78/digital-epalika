<?php

namespace Modules\JudicialCommittee\Http\Controllers\Admin\Api;

use App\Models\Settings\OfficeSetting;
use App\Http\Controllers\Controller;

use Modules\JudicialCommittee\Entities\ComplaintSubject;
use Modules\JudicialCommittee\Enums\ComplainantDefendantTypeEnum;
use Modules\JudicialCommittee\Http\Requests\ComplaintRegistration\StoreComplaintRegistrationRequest;
use Illuminate\Support\Facades\DB;
use Modules\JudicialCommittee\Transformers\ComplaintRegistrationResource;

class ComplaintRegistrationApiController extends Controller
{
    public function complaintRegistration(StoreComplaintRegistrationRequest $request)
    {
        $data = DB::transaction(function () use ($request) {
            $complaintRegistration = auth()->user()
                ?->complaintRegistrations()->create($request->validated() + [
                        'fiscal_year_id' => OfficeSetting::first()->fiscal_year_id,
                        'submission_no' => time(),
                    ]);

            if (!empty($request->validated()['complainantDependents'])) {
                foreach ($request->validated()['complainantDependents'] as $complainantDependent) {
                    $complaintRegistration->complainantDefendants()->create(
                        $complainantDependent + [
                            'type' => ComplainantDefendantTypeEnum::COMPLAINANT
                        ]
                    );
                }
            }

            if (!empty($request->validated()['witnesses'])) {
                foreach ($request->validated()['witnesses'] as $witness) {
                    $complaintRegistration->witnesses()->create(
                        $witness
                        + ['type' => 'wintesses']
                    );
                }
            }

            if (!empty($request->validated()['supportedDocuments'])) {
                foreach ($request->validated()['supportedDocuments'] as $supportedDocument) {
                    $complaintRegistration->supportedDocuments()->create($supportedDocument
                        + ['type' => ComplainantDefendantTypeEnum::COMPLAINANT]);
                }
            }

            if (!empty($request->validated()['relatedMembers'])) {
                foreach ($request->validated()['relatedMembers'] as $relatedMember) {
                    $complaintRegistration->relatedMembers()->create($relatedMember);
                }
            }

            return $complaintRegistration;
        });

        return response()->json([
            'message' => 'Complaint Registered Successfully'
        ], 201);
    }

    public function complaintRegistrationSetting()
    {
        return [
            'complaintSubjects' => ComplaintSubject::selectRaw('id,subject')->get()
        ];
    }

    public function registeredComplain()
    {
        return ComplaintRegistrationResource::collection(auth()->user()
            ?->load(['complaintRegistrations.complaintSubject', 'complaintRegistrations.lawsuitNature'])
            ?->complaintRegistrations);
    }
}

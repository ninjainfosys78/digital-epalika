<?php

namespace Modules\JudicialCommittee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\JudicialCommittee\Entities\ComplaintApplication;
use Modules\JudicialCommittee\Entities\ComplaintDecision;
use Modules\JudicialCommittee\Events\ComplaintLogEvent;
use Modules\JudicialCommittee\Http\Requests\ComplaintDecision\StoreComplaintDecisionRequest;

class ComplaintDecisionController extends Controller
{
    public function index(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('complaintDecision_access');

        if (!$complaintApplication->complaintDecision) {
            return redirect(route('admin.judicialCommittee.complaintApplication.complaintDecision.create', $complaintApplication));
        }

        $complaintApplication->load('complaintDecision.files');

        return view('judicialcommittee::admin.complaint_decision.index', compact('complaintApplication'));
    }

    public function create(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('complaintDecision_create');

        return view('judicialcommittee::admin.complaint_decision.create', compact('complaintApplication'));
    }

    public function store(StoreComplaintDecisionRequest $request, ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('complaintDecision_create');

        $complaintDecision = DB::transaction(function () use ($request, $complaintApplication) {
            $complaintDecision = ComplaintDecision::updateOrCreate(
                ['complaint_application_id' => $complaintApplication->id],
                $request->validated()
            );
            $complaintApplication->update([
                'application_status' => $request->input('application_status')
            ]);

            $this->uploadFiles($request, $complaintDecision);

            return $complaintDecision;
        });

        if ($complaintDecision->wasRecentlyCreated) {
            event(new ComplaintLogEvent($complaintApplication->id, ComplaintDecision::class, $complaintDecision->id, 'निर्णय', "मिति $complaintDecision->submitted_date गते निर्णय पेश गरियो।"));
        }

        toast('निर्णय सफलतापूर्वक पेश गरियो', 'success');

        return redirect(route('admin.judicialCommittee.complaintApplication.complaintDecision.index', $complaintApplication));
    }

    public function show(ComplaintApplication $complaintApplication, ComplaintDecision $complaintDecision)
    {
        return view('judicialcommittee::show');
    }

    public function edit(ComplaintApplication $complaintApplication, ComplaintDecision $complaintDecision)
    {
        return view('judicialcommittee::edit');
    }

    public function update(Request $request, ComplaintApplication $complaintApplication, ComplaintDecision $complaintDecision)
    {
        //
    }

    public function destroy(ComplaintApplication $complaintApplication, ComplaintDecision $complaintDecision)
    {
        //
    }

    private function uploadFiles($request, $complaintDecision)
    {
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $complaintDecision->files()->create([
                    'file_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                    'extension' => $file->getClientOriginalExtension(),
                    'file' => $file->store('judicial_committee/files', 'public'),
                ]);
            }
        }
    }
}

<?php

namespace Modules\JudicialCommittee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\JudicialCommittee\Entities\ComplaintApplication;
use Modules\JudicialCommittee\Entities\ConciliationVerification;
use Modules\JudicialCommittee\Events\ComplaintLogEvent;
use Modules\JudicialCommittee\Http\Requests\ConciliationVerification\StoreConciliationVerificationRequest;

class ConciliationVerificationController extends Controller
{
    public function index(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('conciliationVerification_access');

        if (!$complaintApplication->conciliationVerification) {
            return redirect(route('admin.judicialCommittee.complaintApplication.conciliationVerification.create', $complaintApplication));
        }

        $complaintApplication->load('conciliationVerification.files');

        return view('judicialcommittee::admin.conciliation_verification.index', compact('complaintApplication'));
    }

    public function create(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('conciliationVerification_create');

        return view('judicialcommittee::admin.conciliation_verification.create', compact('complaintApplication'));
    }

    public function store(StoreConciliationVerificationRequest $request, ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('conciliationVerification_create');

        $conciliationVerification = DB::transaction(function () use ($request, $complaintApplication) {
            $conciliationVerification = ConciliationVerification::updateOrCreate(
                ['complaint_application_id' => $complaintApplication->id],
                $request->validated()
            );

            $this->uploadFiles($request, $conciliationVerification);

            return $conciliationVerification;
        });

        if ($conciliationVerification->wasRecentlyCreated) {
            event(new ComplaintLogEvent($complaintApplication->id, ConciliationVerification::class, $conciliationVerification->id, 'मिलापत्र प्रमाणीकरण आदेश', "मिति $conciliationVerification->submitted_date मा न्यायिक समितिले गरेको मिलापत्र प्रमाणीकरण आदेश पेश गरियो।"));
        }

        toast('मिलापत्र प्रमाणीकरण आदेश सफलतापूर्वक पेश गरियो', 'success');

        return redirect(route('admin.judicialCommittee.complaintApplication.conciliationVerification.index', $complaintApplication));
    }

    public function show(ComplaintApplication $complaintApplication, ConciliationVerification $conciliationVerification)
    {
        return view('judicialcommittee::show');
    }

    public function edit(ComplaintApplication $complaintApplication, ConciliationVerification $conciliationVerification)
    {
        return view('judicialcommittee::edit');
    }

    public function update(Request $request, ComplaintApplication $complaintApplication, ConciliationVerification $conciliationVerification)
    {
        //
    }

    public function destroy(ComplaintApplication $complaintApplication, ConciliationVerification $conciliationVerification)
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

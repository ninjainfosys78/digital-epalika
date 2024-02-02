<?php

namespace Modules\JudicialCommittee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\JudicialCommittee\Entities\ComplaintApplication;
use Modules\JudicialCommittee\Entities\ConciliationApplication;
use Modules\JudicialCommittee\Events\ComplaintLogEvent;
use Modules\JudicialCommittee\Http\Requests\ConciliationApplication\StoreConciliationApplicationRequest;

class ConciliationApplicationController extends Controller
{
    public function index(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('conciliationApplication_access');

        if (!$complaintApplication->conciliationApplication) {
            return redirect(route('admin.judicialCommittee.complaintApplication.conciliationApplication.create', $complaintApplication));
        }

        $complaintApplication->load('conciliationApplication.files');

        return view('judicialcommittee::admin.conciliation_application.index', compact('complaintApplication'));
    }

    public function create(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('conciliationApplication_create');

        return view('judicialcommittee::admin.conciliation_application.create', compact('complaintApplication'));
    }

    public function store(StoreConciliationApplicationRequest $request, ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('conciliationApplication_create');

        $conciliationApplication = DB::transaction(function () use ($request, $complaintApplication) {
            $conciliationApplication = ConciliationApplication::updateOrCreate(
                ['complaint_application_id' => $complaintApplication->id],
                $request->validated()
            );

            $this->uploadFiles($request, $conciliationApplication);

            return $conciliationApplication;
        });

        if ($conciliationApplication->wasRecentlyCreated) {
            event(new ComplaintLogEvent($complaintApplication->id, ConciliationApplication::class, $conciliationApplication->id, 'मिलापत्रको निवेदन', "मिति $conciliationApplication->submitted_date मिलापत्रको निवेदन न्यायिक समिति समक्ष पेश गरियो।"));
        }

        toast('मिलापत्रको निवेदन सफलतापूर्वक पेश गरियो', 'success');

        return redirect(route('admin.judicialCommittee.complaintApplication.conciliationApplication.index', $complaintApplication));
    }

    public function show(ComplaintApplication $complaintApplication, ConciliationApplication $conciliationApplication)
    {
        $this->checkAuthorization('conciliationApplication_access');

        return view('judicialcommittee::show');
    }

    public function edit(ComplaintApplication $complaintApplication, ConciliationApplication $conciliationApplication)
    {
        $this->checkAuthorization('conciliationApplication_access');

        return view('judicialcommittee::edit');
    }

    public function update(Request $request, ComplaintApplication $complaintApplication, ConciliationApplication $conciliationApplication)
    {
        $this->checkAuthorization('conciliationApplication_edit');
    }

    public function destroy(ComplaintApplication $complaintApplication, ConciliationApplication $conciliationApplication)
    {
        $this->checkAuthorization('conciliationApplication_delete');
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

<?php

namespace Modules\JudicialCommittee\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\JudicialCommittee\Entities\ComplaintApplication;
use Modules\JudicialCommittee\Entities\Conciliation;
use Modules\JudicialCommittee\Enums\ComplaintApplicationStatusEnum;
use Modules\JudicialCommittee\Events\ComplaintLogEvent;
use Modules\JudicialCommittee\Http\Requests\Conciliation\StoreConciliationRequest;

class ConciliationController extends Controller
{
    public function index(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('conciliation_access');

        if (!$complaintApplication->conciliation) {
            return redirect(route('admin.judicialCommittee.complaintApplication.conciliation.create', $complaintApplication));
        }

        $complaintApplication->load('conciliation.files');

        return view('judicialcommittee::admin.conciliation.index', compact('complaintApplication'));
    }

    public function create(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('conciliation_create');

        return view('judicialcommittee::admin.conciliation.create', compact('complaintApplication'));
    }

    public function store(StoreConciliationRequest $request, ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('conciliation_create');

        $conciliation = DB::transaction(function () use ($request, $complaintApplication) {
            $conciliation = Conciliation::updateOrCreate(
                ['complaint_application_id' => $complaintApplication->id],
                $request->validated()
            );

            $this->uploadFiles($request, $conciliation);

            return $conciliation;
        });

        if ($conciliation->wasRecentlyCreated) {
            event(new ComplaintLogEvent($complaintApplication->id, Conciliation::class, $conciliation->id, 'मिलापत्र', "मिति $conciliation->submitted_date मा मिलापत्र पेश गरियो।"));
            $complaintApplication->update([
                'application_status' => ComplaintApplicationStatusEnum::COMPLETED
            ]);
        }

        toast('मिलापत्र सफलतापूर्वक पेश गरियो', 'success');

        return redirect(route('admin.judicialCommittee.complaintApplication.conciliation.index', $complaintApplication));
    }

    public function show($id)
    {
        return view('judicialcommittee::show');
    }

    public function edit($id)
    {
        return view('judicialcommittee::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
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

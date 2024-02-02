<?php

namespace Modules\JudicialCommittee\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\JudicialCommittee\Entities\ComplaintApplication;
use Modules\JudicialCommittee\Entities\SupportedDocument;
use Modules\JudicialCommittee\Enums\ComplainantDefendantTypeEnum;

class ComplaintApplicationController extends Controller
{
    public function registeredApplications()
    {
        $complaintApplications = ComplaintApplication::with('complaintSubject.lawsuitNature', 'judicialReceiptBill', 'complaintDecision', 'conciliationApplication', 'conciliationVerification')
            ->withCount('dateSheets')
            ->withCount('writtenAnswers')
            ->withCount('defendantIssuedDeadlines')
            ->whereHas('judicialReceiptBill')
            ->where(function (Builder $q) {
                if (!is_null(request('search'))) {
                    $q->whereLike(['submission_no', 'registration_no', 'subject', 'date'], request('search'));
                }
            })->orderByDesc('date')->paginate(10);

        return view('judicialcommittee::admin.complaint_application.registered_application', compact('complaintApplications'));
    }

    public function index()
    {
        $this->checkAuthorization('complaintApplication_access');

        $complaintApplications = ComplaintApplication::with('complaintSubject.lawsuitNature')
            ->where(function (Builder $q) {
                if (!is_null(request('search'))) {
                    $q->whereLike(['submission_no', 'registration_no', 'subject', 'date'], request('search'));
                }
            })->orderByDesc('date')->paginate(10);

        return view('judicialcommittee::admin.complaint_application.index', compact('complaintApplications'));
    }

    public function create()
    {
        $this->checkAuthorization('complaintApplication_create');

        return view('judicialcommittee::admin.complaint_application.create');
    }

    public function show(ComplaintApplication $complaintApplication)
    {

        $this->checkAuthorization('complaintApplication_access');
        $complaintApplication->load('lawsuitNature', 'judicialReceiptBill', 'relatedMembers', 'complainantDefendants', 'complainantDefendants.province', 'complainantDefendants.district', 'complainantDefendants.localBody', 'witnesses', 'defendantIssuedDeadlines');
        return view('judicialcommittee::admin.complaint_application.show', compact('complaintApplication'));
    }

    public function edit(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('complaintApplication_edit');

        $complaintApplication->load('complainantDefendants', 'relatedMembers', 'witnesses');

        return view('judicialcommittee::admin.complaint_application.edit', compact('complaintApplication'));
    }

    public function storeWitness(Request $request, ComplaintApplication $complaintApplication)
    {
        $validated = $request->validate(
            [
            'name' => ['required', 'string', 'max:255'],
            'age' => ['nullable', 'integer'],
            'phone' => ['nullable'],
            'address' => ['nullable'],
        ],
            ['name.required' => 'नाम आवश्यक छ'],
        );

        $complaintApplication->witnesses()->create($validated + [
                'type' => ComplainantDefendantTypeEnum::DEFENDANT,
            ]);

        toast('साक्षी सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function uploadSupportedDocument(Request $request, ComplaintApplication $complaintApplication)
    {
        $request->validate(
            [
            'document_name' => ['required', 'string', 'max:255'],
            'document' => ['required', 'mimes:jpg,jpeg,png,pdf']
        ],
            ['document_name.required' => 'फाइलको नाम आवश्यक छ'],
            ['document.required' => 'फाइल आवश्यक छ'],
        );

        $complaintApplication->supportedDocuments()->create([
            'type' => ComplainantDefendantTypeEnum::DEFENDANT,
            'document_name' => $request->input('document_name'),
            'document' => $request->file('document')
        ]);

        toast('फाइल सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function destroy(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('complaintApplication_delete');

        if ($complaintApplication->applicant_signature) {
            $this->deleteFile($complaintApplication->applicant_signature);
        }

        $complaintApplication->relatedMembers()->delete();
        $complaintApplication->complainantDefendants()->delete();
        if ($complaintApplication->applicant_signature) {
            $this->deleteFile($complaintApplication->applicant_signature);
        }
        $complaintApplication->delete();

        toast('आवेदन सफलतापूर्वक मेटाइयो', 'success');

        return back();
    }

    public function deleteSupportedDocument(ComplaintApplication $complaintApplication, SupportedDocument $supportedDocument)
    {
        if ($supportedDocument->document) {
            $this->deleteFile($supportedDocument->document);
        }
        $supportedDocument->delete();

        toast('फाइल सफलतापूर्वक मेटियो', 'success');

        return back();
    }
}

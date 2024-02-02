<?php

namespace Modules\JudicialCommittee\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Modules\JudicialCommittee\Entities\ComplaintSubject;
use Modules\JudicialCommittee\Entities\LawsuitNature;
use Modules\JudicialCommittee\Http\Requests\ComplaintSubject\StoreComplaintSubjectRequest;
use Modules\JudicialCommittee\Http\Requests\ComplaintSubject\UpdateComplaintSubjectRequest;

class ComplaintSubjectController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('complaintSubject_access');

        $complaintSubjects = ComplaintSubject::with('lawsuitNature')->get();

        return view('judicialcommittee::admin.setting.complaint_subject.index', compact('complaintSubjects'));
    }

    public function create()
    {
        $this->checkAuthorization('complaintSubject_create');

        $lawsuitNatures = LawsuitNature::all();

        return view('judicialcommittee::admin.setting.complaint_subject.create', compact('lawsuitNatures'));
    }

    public function store(StoreComplaintSubjectRequest $request)
    {
        $this->checkAuthorization('complaintSubject_create');

        ComplaintSubject::create($request->validated());

        toast('उजुरी विषय सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(ComplaintSubject $complaintSubject)
    {
        return view('judicialcommittee::show');
    }

    public function edit(ComplaintSubject $complaintSubject)
    {
        $this->checkAuthorization('complaintSubject_edit');

        $lawsuitNatures = LawsuitNature::all();

        return view('judicialcommittee::admin.setting.complaint_subject.edit', compact('complaintSubject', 'lawsuitNatures'));
    }

    public function update(UpdateComplaintSubjectRequest $request, ComplaintSubject $complaintSubject)
    {
        $this->checkAuthorization('complaintSubject_edit');

        $complaintSubject->update($request->validated());

        toast('उजुरी विषय सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.judicialCommittee.setting.complaintSubject.index'));
    }

    public function destroy(ComplaintSubject $complaintSubject)
    {
        $this->checkAuthorization('complaintSubject_delete');

        $complaintSubject->delete();

        toast('उजुरी विषय सफलतापूर्वक हटाइयो', 'success');

        return back();
    }
}

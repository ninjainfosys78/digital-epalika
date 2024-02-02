<?php

namespace Modules\JudicialCommittee\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\JudicialCommittee\Entities\ComplaintApplication;
use Modules\JudicialCommittee\Entities\DateCompensation;
use Modules\JudicialCommittee\Entities\JudicialCommitteeTemplate;
use Modules\JudicialCommittee\Enums\JudicialTemplateTypeEnum;
use Modules\JudicialCommittee\Events\ComplaintLogEvent;
use Modules\JudicialCommittee\Http\Requests\DateCompensation\StoreDateCompensationRequest;
use Modules\JudicialCommittee\Http\Requests\DateCompensation\UpdateDateCompensationRequest;

class DateCompensationController extends Controller
{
    public function index(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('dateCompensation_access');

        return view('judicialcommittee::admin.date_compensation.index', compact('complaintApplication'));
    }

    public function create(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('dateCompensation_create');

        return view('judicialcommittee::admin.date_compensation.create', compact('complaintApplication'));
    }

    public function store(StoreDateCompensationRequest $request, ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('dateCompensation_create');

        $dateCompensation = $complaintApplication->dateCompensations()->create($request->validated());

        event(new ComplaintLogEvent($complaintApplication->id, DateCompensation::class, $dateCompensation->id, 'तारिख भरपाई', "मिति $dateCompensation->decision_date गते समय $dateCompensation->decision_time मा $dateCompensation->decision_subject विषयमा निर्णय हुने छ भनेर तारिख भरपाई गरियो।"));

        toast('तारिख भरपाई सफलतापूर्वक पेश गरियो', 'success');

        return redirect(route('admin.judicialCommittee.complaintApplication.dateCompensation.index', $complaintApplication));
    }

    public function show(ComplaintApplication $complaintApplication, DateCompensation $dateCompensation)
    {
        $this->checkAuthorization('dateCompensation_access');

        if (JudicialCommitteeTemplate::where('type', JudicialTemplateTypeEnum::DATE_COMPENSATION)->count() == 0) {
            toast('टेम्प्लेट सेट गरिएको छैन', 'error');
            return redirect(route('admin.judicialCommittee.judicialCommitteeTemplate.index'));
        }

        return view('judicialcommittee::admin.date_compensation.show', compact('dateCompensation', 'complaintApplication'));
    }

    public function edit(ComplaintApplication $complaintApplication, DateCompensation $dateCompensation)
    {
        $this->checkAuthorization('dateCompensation_access');

        return view('judicialcommittee::admin.date_compensation.edit', compact('complaintApplication', 'dateCompensation'));
    }

    public function update(UpdateDateCompensationRequest $request, ComplaintApplication $complaintApplication, DateCompensation $dateCompensation)
    {
        $this->checkAuthorization('dateCompensation_edit');

        $dateCompensation->update($request->validated());

        toast('तारिख भरपाई सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.judicialCommittee.complaintApplication.dateCompensation.index', $complaintApplication));
    }

    public function destroy(ComplaintApplication $complaintApplication, DateCompensation $dateCompensation)
    {
        $this->checkAuthorization('dateCompensation_delete');
    }
}

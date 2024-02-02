<?php

namespace Modules\JudicialCommittee\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\JudicialCommittee\Entities\ComplaintApplication;
use Modules\JudicialCommittee\Entities\DefendantIssuedDeadline;
use Modules\JudicialCommittee\Entities\JudicialCommitteeTemplate;
use Modules\JudicialCommittee\Enums\JudicialTemplateTypeEnum;
use Modules\JudicialCommittee\Events\ComplaintLogEvent;
use Modules\JudicialCommittee\Http\Requests\DefendantIssuedDeadline\StoreDefendantIssuedDeadlineRequest;
use Modules\JudicialCommittee\Http\Requests\DefendantIssuedDeadline\UpdateDefendantIssuedDeadlineRequest;

class DefendantIssuedDeadlineController extends Controller
{
    public function index(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('defendantIssuedDeadline_access');

        $complaintApplication->load('defendantIssuedDeadlines');

        return view('judicialcommittee::admin.defendant_issued_deadline.index', compact('complaintApplication'));
    }

    public function create(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('defendantIssuedDeadline_create');

        return view('judicialcommittee::admin.defendant_issued_deadline.create', compact('complaintApplication'));
    }

    public function store(StoreDefendantIssuedDeadlineRequest $request, ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('defendantIssuedDeadline_create');

        $defendantIssuedDeadline = $complaintApplication->defendantIssuedDeadlines()->create($request->validated());

        event(new ComplaintLogEvent($complaintApplication->id, DefendantIssuedDeadline::class, $defendantIssuedDeadline->id, 'प्रतिवादी म्याद जारी', "$defendantIssuedDeadline->day_to_attend दिन भित्रमा न्यायिक समिति समक्ष हाजिर हुन आउनुहोला भनेर प्रतिवादी म्याद जारी गरियो।"));

        toast('प्रतिवादी म्याद जारी सफलतापूर्वक पेश गरियो', 'success');

        return redirect(route('admin.judicialCommittee.complaintApplication.defendantIssuedDeadline.index', $complaintApplication));
    }

    public function show(ComplaintApplication $complaintApplication, DefendantIssuedDeadline $defendantIssuedDeadline)
    {
        $this->checkAuthorization('defendantIssuedDeadline_access');

        if (JudicialCommitteeTemplate::where('type', JudicialTemplateTypeEnum::DEFENDANT_ISSUED_DEADLINE)->count() == 0) {
            toast('टेम्प्लेट सेट गरिएको छैन', 'error');
            return redirect(route('admin.judicialCommittee.setting.judicialCommitteeTemplate.index'));
        }

        return view('judicialcommittee::admin.defendant_issued_deadline.show', compact('complaintApplication', 'defendantIssuedDeadline'));
    }

    public function edit(ComplaintApplication $complaintApplication, DefendantIssuedDeadline $defendantIssuedDeadline)
    {
        $this->checkAuthorization('defendantIssuedDeadline_edit');

        return view('judicialcommittee::admin.defendant_issued_deadline.edit', compact('complaintApplication', 'defendantIssuedDeadline'));
    }

    public function update(UpdateDefendantIssuedDeadlineRequest $request, ComplaintApplication $complaintApplication, DefendantIssuedDeadline $defendantIssuedDeadline)
    {
        $this->checkAuthorization('defendantIssuedDeadline_edit');

        $defendantIssuedDeadline->update($request->validated());

        toast('प्रतिवादी म्याद जारी सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.judicialCommittee.complaintApplication.defendantIssuedDeadline.index', $complaintApplication));
    }

    public function destroy(ComplaintApplication $complaintApplication, DefendantIssuedDeadline $defendantIssuedDeadline)
    {
        //
    }
}

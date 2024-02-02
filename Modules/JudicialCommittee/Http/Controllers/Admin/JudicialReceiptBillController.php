<?php

namespace Modules\JudicialCommittee\Http\Controllers\Admin;

use App\Models\Settings\OfficeSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Modules\JudicialCommittee\Entities\ComplaintApplication;
use Modules\JudicialCommittee\Entities\JudicialCommitteeTemplate;
use Modules\JudicialCommittee\Entities\JudicialReceiptBill;
use Modules\JudicialCommittee\Enums\ComplaintApplicationStatusEnum;
use Modules\JudicialCommittee\Enums\JudicialTemplateTypeEnum;
use Modules\JudicialCommittee\Events\ComplaintLogEvent;
use Modules\JudicialCommittee\Http\Requests\JudicialReceiptBillRequest;

class JudicialReceiptBillController extends Controller
{
    public function index(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('judicialReceiptBill_access');

        if (JudicialCommitteeTemplate::where('type', JudicialTemplateTypeEnum::JUDICIAL_RECEIPT_BILL)->count() == 0) {
            toast('टेम्प्लेट सेट गरिएको छैन', 'error');
            return redirect(route('admin.judicialCommittee.setting.judicialCommitteeTemplate.index'));
        }

        return view('judicialcommittee::admin.receipt_bill.index', compact('complaintApplication'));
    }

    public function create(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('judicialReceiptBill_create');

        return view('judicialcommittee::admin.receipt_bill.create', compact('complaintApplication'));
    }

    public function store(JudicialReceiptBillRequest $request, ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('judicialReceiptBill_access');

        $officeSetting = OfficeSetting::with('fiscalYear')->first();

        $judicialReceiptBill = JudicialReceiptBill::updateOrCreate(
            ['complaint_application_id' => $complaintApplication->id],
            $request->validated()
        );

        if ($judicialReceiptBill->wasRecentlyCreated) {
            $complaintApplication->update([
                'registration_no' => $officeSetting->fiscalYear->title . '-' . ($complaintApplication->lawsuitNature->code ?? '') . '-' . Str::padLeft($complaintApplication->id, 4, 0),
                'application_status' => ComplaintApplicationStatusEnum::PENDING
            ]);
            event(new ComplaintLogEvent($complaintApplication->id, JudicialReceiptBill::class, $judicialReceiptBill->id, 'दर्ता शुल्क तिरेको', "$judicialReceiptBill->bill_date बिल मितिमा निवेदन दर्ता को लागि दर्ता शुल्क तिरेको"));
        }

        toast('दर्ता दस्तुर विवरण सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.judicialCommittee.complaintApplication.judicialReceiptBill.index', $complaintApplication));
    }

    public function show(ComplaintApplication $complaintApplication, JudicialReceiptBill $judicialReceiptBill)
    {
        return view('judicialcommittee::show');
    }

    public function edit(ComplaintApplication $complaintApplication, JudicialReceiptBill $judicialReceiptBill)
    {
        return view('judicialcommittee::edit');
    }

    public function update(Request $request, ComplaintApplication $complaintApplication, JudicialReceiptBill $judicialReceiptBill)
    {
        //
    }

    public function destroy(ComplaintApplication $complaintApplication, JudicialReceiptBill $judicialReceiptBill)
    {
        //
    }
}

<?php

namespace Modules\JudicialCommittee\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\JudicialCommittee\Entities\ComplaintApplication;
use Modules\JudicialCommittee\Entities\DateSheet;
use Modules\JudicialCommittee\Events\ComplaintLogEvent;
use Modules\JudicialCommittee\Http\Requests\DateSheet\StoreDateSheetRequest;
use Modules\JudicialCommittee\Http\Requests\DateSheet\UpdateDateSheetRequest;

class DateSheetController extends Controller
{
    public function index(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('dateSheet_access');

        $complaintApplication->load('dateSheets');

        return view('judicialcommittee::admin.date_sheet.index', compact('complaintApplication'));
    }

    public function create(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('dateSheet_create');

        return view('judicialcommittee::admin.date_sheet.create', compact('complaintApplication'));
    }

    public function store(StoreDateSheetRequest $request, ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('dateSheet_create');

        $dateSheet = $complaintApplication->dateSheets()->create($request->validated());

        event(new ComplaintLogEvent($complaintApplication->id, DateSheet::class, $dateSheet->id, 'तारिख पर्चा', "$dateSheet->appearance_date गते समय $dateSheet->appearance_time को लागि तारिख पर्चा थपियो"));

        toast('तारिख पर्चा सफलतापूर्वक पेश गरियो', 'success');

        return redirect(route('admin.judicialCommittee.complaintApplication.dateSheet.index', $complaintApplication));
    }

    public function show(ComplaintApplication $complaintApplication, DateSheet $dateSheet)
    {
        $this->checkAuthorization('dateSheet_access');

        return view('judicialcommittee::admin.date_sheet.show', compact('complaintApplication', 'dateSheet'));
    }

    public function edit(ComplaintApplication $complaintApplication, DateSheet $dateSheet)
    {
        $this->checkAuthorization('dateSheet_edit');

        return view('judicialcommittee::admin.date_sheet.edit', compact('complaintApplication', 'dateSheet'));
    }

    public function update(UpdateDateSheetRequest $request, ComplaintApplication $complaintApplication, DateSheet $dateSheet)
    {
        $this->checkAuthorization('dateSheet_edit');

        $dateSheet->update($request->validated());

        toast('तारिख पर्चा सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.judicialCommittee.complaintApplication.dateSheet.index', $complaintApplication));
    }

    public function destroy(ComplaintApplication $complaintApplication, DateSheet $dateSheet)
    {
        //
    }
}

<?php

namespace Modules\JudicialCommittee\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings\FiscalYear;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Modules\JudicialCommittee\Entities\ComplaintApplication;
use Modules\JudicialCommittee\Entities\ComplaintSubject;
use Modules\JudicialCommittee\Entities\LawsuitNature;
use Modules\JudicialCommittee\Enums\ComplainantDefendantTypeEnum;
use Modules\JudicialCommittee\Enums\ComplaintApplicationStatusEnum;
use Modules\JudicialCommittee\Transformers\Report\ComplaintApplicationResource;

class ReportController extends Controller
{
    public function index()
    {
        $fiscalYears = FiscalYear::get();
        $lawsuitNatures = LawsuitNature::all();
        $columnData = $this->getColumns();

        return view('judicialcommittee::admin.report.index', compact('fiscalYears', 'lawsuitNatures', 'columnData'));
    }

    private function getColumns(): Collection
    {
        $columnData = collect();

        (new ComplaintApplication())
            ->ownAndRelatedModelsFillableColumns()
            ->filter(function ($column) {
                return !array_keys($column, 'printedData');
            })
            ->each(function ($column) use ($columnData) {
                $columnData->push(collect($column)->put('columns', $column['columns']));
            });
        return $columnData;
    }

    public function report(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'to_date' => ['nullable', 'after_or_equal:from_date'],
            'columns' => ['nullable', 'array']
        ]);

        if (empty($request->input('columns'))) {
            $request->request->add(
                ['columns' =>
                    [
                        'complaint_applications' => ['submission_no', 'registration_no', 'date', 'subject', 'lawsuit_nature_id']
                    ]
                ]
            );
        }

        $complaintApplications = ComplaintApplication::with('fiscalYear', 'lawsuitNature')
            ->where(function ($q) use ($request) {
                $this->filterDataFromUser($q, $request);
            })
            ->get();
        if (!empty($request->input('columns')['complainant_defendants'])) {
            $complaintApplications->load('complainantDefendants.province', 'complainantDefendants.district', 'complainantDefendants.localBody');
        }
        if (!empty($request->input('columns')['witnesses'])) {
            $complaintApplications->load('witnesses');
        }
        if (!empty($request->input('columns')['related_members'])) {
            $complaintApplications->load('relatedMembers');
        }
        if (!empty($request->input('columns')['date_sheets'])) {
            $complaintApplications->load('dateSheets');
        }
        if (!empty($request->input('columns')['defendant_issued_deadlines'])) {
            $complaintApplications->load('defendantIssuedDeadlines');
        }

        return response()->json([
            'data' => ComplaintApplicationResource::collection($complaintApplications)
        ]);
    }

    private function filterDataFromUser($q, Request $request): void
    {
        if (!empty($request->input('fiscal_year'))) {
            $q->whereIn('fiscal_year_id', Arr::wrap($request->input('fiscal_year')));
        }

        if (!empty($request->input('lawsuit_nature_id'))) {
            $q->whereIn('lawsuit_nature_id', Arr::wrap($request->input('lawsuit_nature_id')));
        }

        if (!empty($request->input('from_date'))) {
            $q->whereDate('date', '>=', $request->input('from_date'));
        }

        if (!empty($request->input('to_date'))) {
            $q->whereDate('date', '<=', $request->input('to_date'));
        }
    }

    public function complainantDefendantReportPage()
    {
        $fiscalYears = FiscalYear::all();
        $lawsuitNatures = LawsuitNature::all();

        return view('judicialcommittee::admin.report.complainant_defendant_report', compact('fiscalYears', 'lawsuitNatures'));
    }

    public function getComplainantDefendantData(Request $request)
    {
        $complaintApplications = ComplaintApplication::with('complainantDefendants')->where(function ($q) use ($request) {
            $this->filterDataFromUser($q, $request);
        })->get()
            ->map(function ($complaintApplication, $key) {
                return [
                    'sn' => (int)$key + 1,
                    'subject' => $complaintApplication->subject ?? '',
                    'complainant' => $complaintApplication->complainantDefendants->where('type', ComplainantDefendantTypeEnum::COMPLAINANT)->pluck('name'),
                    'defendant' => $complaintApplication->complainantDefendants->where('type', ComplainantDefendantTypeEnum::DEFENDANT)->pluck('name'),
                    'registration_no' => $complaintApplication->registration_no ?? '',
                    'application_status' => $complaintApplication->application_status?->label()
                ];
            });

        return response()->json([
            'data' => $complaintApplications
        ]);
    }

    public function complaintSubjectWiseReportPage()
    {
        $fiscalYears = FiscalYear::all();
        $lawsuitNatures = LawsuitNature::all();

        return view('judicialcommittee::admin.report.complaint_subject_wise_report', compact('fiscalYears', 'lawsuitNatures'));
    }

    public function getComplaintSubjectWiseData(Request $request)
    {
        $complaintSubjects = ComplaintSubject::with(['complaintApplications' => function ($query) use ($request) {
            $this->filterDataFromUser($query, $request);
        }])->get()->map(function ($complaintSubject, $key) {
            return [
                'sn' => (int)$key + 1,
                'subject' => $complaintSubject->subject ?? '',
                'total' => $complaintSubject->complaintApplications->count(),
                'completed' => $complaintSubject->complaintApplications->where('application_status', ComplaintApplicationStatusEnum::COMPLETED)->count(),
                'pending' => $complaintSubject->complaintApplications->where('application_status', ComplaintApplicationStatusEnum::PENDING)->count(),
                'recommended' => $complaintSubject->complaintApplications->where('application_status', ComplaintApplicationStatusEnum::RECOMMENDED)->count(),
                'society_conciliated' => $complaintSubject->complaintApplications->where('application_status', ComplaintApplicationStatusEnum::SOCIETY_CONCILIATED)->count(),
            ];
        });

        return response()->json([
            'data' => $complaintSubjects
        ]);
    }
}

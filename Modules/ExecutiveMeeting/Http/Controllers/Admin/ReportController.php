<?php

namespace Modules\ExecutiveMeeting\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings\FiscalYear;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Modules\ExecutiveMeeting\Entities\Committee;
use Modules\ExecutiveMeeting\Entities\Meeting;
use Modules\ExecutiveMeeting\Transformers\MeetingResourceReport;

class ReportController extends Controller
{
    public function index()
    {
        $fiscalYears = FiscalYear::all();
        $committees = Committee::all();
        $columnData = $this->getColumns();
        return view('executivemeeting::admin.report.index', compact('committees', 'fiscalYears', 'columnData'));
    }

    public function report(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => ['nullable', Rule::exists('fiscal_years', 'id')->withoutTrashed()],
            'committee' => ['nullable', 'array'],
            'committee.*' => ['nullable', Rule::exists('committees', 'id')->withoutTrashed()],
            'to_date' => ['nullable', 'after_or_equal:from_date'],
            'columns' => ['nullable', 'array']
        ]);

        if (empty($request->input('columns'))) {
            $request->request->add(
                ['columns' =>
                    [
                        'meetings' => ['meeting_name', 'recurrence', 'start_date', 'en_start_date']
                    ]
                ]
            );
        }

        $meetings = Meeting::with('fiscalYear', 'committee')->where(function ($q) use ($request) {
            $this->filterDataFromUser($q, $request);
        })->get();

        return response()->json([
            'data' => MeetingResourceReport::collection($meetings)
        ]);
    }

    private function getColumns(): Collection
    {
        $columnData = collect();

        (new Meeting())
            ->ownAndRelatedModelsFillableColumns()
            ->filter(function ($column) {
                return array_keys($column, 'Meeting');
            })
            ->each(function ($column) use ($columnData) {
                $columnData->push(collect($column)->put('columns', $column['columns']));
            });
        return $columnData;
    }

    private function filterDataFromUser($q, Request $request): void
    {
        if (!empty($request->input('fiscal_year'))) {
            $q->whereIn('fiscal_year_id', $request->input('fiscal_year'));
        }

        if (!empty($request->input('from_date'))) {
            $q->whereDate('start_date', '>=', $request->input('from_date'));
        }

        if (!empty($request->input('to_date'))) {
            $q->whereDate('end_date', '<=', $request->input('to_date'));
        }

        if (!empty($request->input('committee'))) {
            $q->whereIn('committee_id', $request->input('committee'));
        }
    }
}

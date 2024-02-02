<?php

namespace Modules\Circular\Http\Controllers\Admin;

use App\Models\Settings\FiscalYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Modules\Circular\Entities\Dispatch;
use Modules\Circular\Transformers\Report\DispatchResource;

class DispatchReportController extends Controller
{
    public function index()
    {
        $fiscalYears = FiscalYear::all();
        $columnData = $this->getColumns();

        return view('circular::admin.report.dispatch.index', compact('fiscalYears', 'columnData'));
    }

    public function report(Request $request)
    {
        $request->validate([
            'en_from_dispatch_date' => ['nullable'],
            'en_to_dispatch_date' => ['nullable', 'after_or_equal:en_from_dispatch_date'],
            'en_from_letter_date' => ['nullable'],
            'en_to_letter_date' => ['nullable', 'after_or_equal:en_from_letter_date'],
            'columns' => ['nullable', 'array']
        ]);

        if (empty($request->input('columns'))) {
            $request->request->add(
                ['columns' =>
                    [
                        'dispatches' => ['dispatch_no', 'dispatch_date', 'letter_number', 'letter_date', 'subject']
                    ]
                ]
            );
        }

        $dispatches = Dispatch::with('fiscalYear')->where(function ($q) use ($request) {
            $this->filterDataFromUser($q, $request);
        })->get();

        return response()->json([
            'data' => DispatchResource::collection($dispatches)
        ]);
    }

    private function getColumns(): Collection
    {
        $columnData = collect();

        (new Dispatch())
            ->ownAndRelatedModelsFillableColumns()
            ->filter(function ($column) {
                return !array_keys($column, 'printedData');
            })
            ->each(function ($column) use ($columnData) {
                $columnData->push(collect($column)->put('columns', $column['columns']));
            });
        return $columnData;
    }

    public function filterDataFromUser($q, Request $request): void
    {
        if (!empty($request->input('fiscal_year'))) {
            $q->whereIn('fiscal_year_id', $request->input('fiscal_year'));
        }

        if (!empty($request->input('en_from_dispatch_date'))) {
            $q->whereDate('en_dispatch_date', '>=', $request->input('en_from_dispatch_date'));
        }

        if (!empty($request->input('en_to_dispatch_date'))) {
            $q->whereDate('en_dispatch_date', '<=', $request->input('en_to_dispatch_date'));
        }
        if (!empty($request->input('en_from_letter_date'))) {
            $q->whereDate('en_letter_date', '>=', $request->input('en_from_letter_date'));
        }
        if (!empty($request->input('en_to_letter_date'))) {
            $q->whereDate('en_letter_date', '<=', $request->input('en_to_letter_date'));
        }

        if (!empty($request->input('dispatch_no'))) {
            $q->where('dispatch_no', $request->input('dispatch_no'));
        }
        if (!empty($request->input('letter_number'))) {
            $q->where('letter_number', $request->input('letter_number'));
        }
    }
}

<?php

namespace Modules\ListRegistration\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings\FiscalYear;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Modules\ListRegistration\Entities\ListRegistration;
use Modules\ListRegistration\Transformers\Report\ListRegistrationResource;

class ReportController extends Controller
{
    public function index()
    {
        $fiscalYears = FiscalYear::get();
        $columnData = $this->getColumns();
        return view('listregistration::admin.report.index', compact('fiscalYears', 'columnData'));

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
                        'list_registrations' => ['registration_no', 'applicant_type', 'main_person', 'mobile_no', 'date']
                    ]
                ]
            );
        }

        $listRegistrations = ListRegistration::with('fiscalYear')->where(function ($q) use ($request) {
            $this->filterDataFromUser($q, $request);
        })->get();

        return response()->json([
            'data' => ListRegistrationResource::collection($listRegistrations)
        ]);
    }

    private function getColumns(): Collection
    {
        $columnData = collect();

        (new ListRegistration())
            ->ownAndRelatedModelsFillableColumns()
            ->filter(function ($column) {
                return !array_keys($column, 'printedData');
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
            $q->whereDate('date', '>=', $request->input('from_date'));
        }

        if (!empty($request->input('to_date'))) {
            $q->whereDate('date', '<=', $request->input('to_date'));
        }

        if (!empty($request->input('registration_no'))) {
            $q->where('registration_no', $request->input('registration_no'));
        }

        if (!empty($request->input('applicant_type'))) {
            $q->whereIn('applicant_type', $request->input('applicant_type'));
        }

        if (!empty($request->input('business_nature'))) {
            $q->whereIn('business_nature', $request->input('business_nature'));
        }
    }
}

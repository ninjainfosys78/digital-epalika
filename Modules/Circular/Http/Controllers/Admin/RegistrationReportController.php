<?php

namespace Modules\Circular\Http\Controllers\Admin;

use App\Models\Settings\FiscalYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Modules\Circular\Entities\Registration;
use Modules\Circular\Transformers\Report\RegistrationResource;

class RegistrationReportController extends Controller
{
    public function index()
    {
        $fiscalYears = FiscalYear::get();
        $columnData = $this->getColumns();

        return view('circular::admin.report.registration.index', compact('fiscalYears', 'columnData'));
    }

    public function report(Request $request)
    {
        if (empty($request->input('columns'))) {
            $request->request->add(
                ['columns' =>
                    [
                        'registrations' => ['registration_no', 'registration_date', 'letter_number', 'letter_date', 'subject','receiver_name']
                    ]
                ]
            );
        }

        $registrations = Registration::with('fiscalYear')->where(function ($q) use ($request) {
            $this->filterDataFromUser($q, $request);
        })->get();

        return response()->json([
            'data' => RegistrationResource::collection($registrations)
        ]);
    }

    private function getColumns(): Collection
    {
        $columnData = collect();

        (new Registration())
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

        if (!empty($request->input('en_from_registration_date'))) {
            $q->whereDate('en_registration_date', '>=', $request->input('en_from_registration_date'));
        }

        if (!empty($request->input('en_to_registration_date'))) {
            $q->whereDate('en_registration_date', '<=', $request->input('en_to_registration_date'));
        }
        if (!empty($request->input('en_from_letter_date'))) {
            $q->whereDate('en_letter_date', '>=', $request->input('en_from_letter_date'));
        }
        if (!empty($request->input('en_to_letter_date'))) {
            $q->whereDate('en_letter_date', '<=', $request->input('en_to_letter_date'));
        }

        if (!empty($request->input('registration_no'))) {
            $q->where('registration_no', $request->input('registration_no'));
        }
        if (!empty($request->input('letter_number'))) {
            $q->where('letter_number', $request->input('letter_number'));
        }
    }
}

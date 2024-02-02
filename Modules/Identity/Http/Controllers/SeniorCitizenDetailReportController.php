<?php

namespace Modules\Identity\Http\Controllers;

use App\Models\Settings\FiscalYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Modules\Identity\Entities\SeniorCitizenDetail;
use Modules\Identity\Transformers\SeniorCitizenDetailResource;

class SeniorCitizenDetailReportController extends Controller
{
    public function index()
    {
        $fiscalYears = FiscalYear::all();
        $columnData = $this->getColumns();
        return view('identity::admin.seniorCitizen.report', compact('fiscalYears', 'columnData'));
    }


    private function getColumns(): Collection
    {
        $columnData = collect();

        (new SeniorCitizenDetail())
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
                        'senior_citizen_details' => ['name', 'gender','card_no','dob_bs','blood_group']
                    ]
                ]
            );
        }

        $seniorCitizenDetail = SeniorCitizenDetail::with($this->relations)
            ->where(function ($q) use ($request) {
                $this->filterDataFromUser($q, $request);
            })
            ->get();


        return response()->json([
            'data' => SeniorCitizenDetailResource::collection($seniorCitizenDetail),
        ]);
    }

    private array $relations = [
        'fiscalYear',
        'province',
        'district',
        'localBody',
        'employeeSignature',
    ];

    private function filterDataFromUser($q, Request $request): void
    {
        if (!empty($request->input('fiscal_year'))) {
            $q->whereIn('fiscal_year_id', Arr::wrap($request->input('fiscal_year')));
        }

        if (!empty($request->input('from_date'))) {
            $q->whereDate('created_at', '>=', $request->input('from_date'));
        }

        if (!empty($request->input('to_date'))) {
            $q->whereDate('created_at', '<=', $request->input('to_date'));
        }
    }

    public function seniorCitizenWardWise()
    {
        $fiscalYears = FiscalYear::all();
        return view('identity::admin.report.seniorCitizenWardWise', compact('fiscalYears'));
    }

    public function seniorCitizenWardWiseReport(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'to_date' => ['nullable'],
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')],
        ]);

        $seniorCitizenDetails = SeniorCitizenDetail::where(function ($query) use ($request) {
            $this->filterDataFromUser($query, $request);
        })->get();

        $wardData = [];
        foreach (officeSetting()->localBody->ward_no as $ward_no) {
            $wardData[] = $seniorCitizenDetails->where('ward_no', $ward_no)->count();
        }

        return response()->json([
            'view' => (string)View::make('identity::admin.report.inc.seniorCitizenWardWise', compact('wardData', 'seniorCitizenDetails'))
        ]);
    }
}

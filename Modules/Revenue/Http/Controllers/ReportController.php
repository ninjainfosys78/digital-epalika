<?php

namespace Modules\Revenue\Http\Controllers;

use App\Models\Settings\FiscalYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Modules\Revenue\Entities\Invoice;
use Modules\Revenue\Entities\TaxPayerType;
use Modules\Revenue\Transformers\InvoiceResource;

class ReportController extends Controller
{
    public function index()
    {
        $fiscalYears = FiscalYear::all();
        $columnData = $this->getColumns();
        return view('revenue::admin.report.index', compact('fiscalYears', 'columnData'));
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
                        'invoices' => ['invoice_no', 'name', 'address', 'payment_method']
                    ]
                ]
            );
        }

        $invoices = Invoice::with('taxPayer', 'fiscalYear')->where(function ($q) use ($request) {
            $this->filterDataFromUser($q, $request);
        })->get();

        if (!empty($request->input('columns')['invoice_particulars'])) {
            $invoices->load('InvoiceParticulars');
        }


        return response()->json([
            'data' => InvoiceResource::collection($invoices)
        ]);
    }

    private function getColumns(): \Illuminate\Support\Collection
    {
        $columnData = collect();

        (new Invoice())
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
        if (!empty($request->input('tax_payer_type'))) {
            $q->whereIn('tax_payer_type_id', $request->input('tax_payer_type'));
        }

        if (!empty($request->input('from_date'))) {
            $q->whereDate('payment_date', '>=', $request->input('from_date'));
        }

        if (!empty($request->input('to_date'))) {
            $q->whereDate('payment_date', '<=', $request->input('to_date'));
        }

        if (!empty($request->input('payment_method'))) {
            $q->where('payment_method', $request->input('payment_method'));
        }
        if (!empty($request->input('ward_no'))) {
            $q->whereIn('ward', $request->input('ward_no'));
        }
    }

    public function invoice()
    {
        $fiscalYears = FiscalYear::all();
        return view('revenue::admin.report.invoice', compact('fiscalYears'));
    }

    public function invoiceReport(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'to_date' => ['nullable'],
            'payment_method' => ['nullable'],
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')],
        ]);
        $invoices = Invoice::where(function ($query) use ($request) {
            $this->filterDataFromUser($query, $request);
        })->get();
        $wardData = [];
        foreach (officeSetting()->localBody->ward_no as $ward_no) {
            $wardData[] = $invoices->where('ward', $ward_no)->count();
        }


        return response()->json([
            'fiscal_years' => !empty($request->input('fiscal_year')) ? FiscalYear::select('title')->whereIn('id', Arr::wrap($request->input('fiscal_year')))->pluck('title') : FiscalYear::pluck('title'),
            'wardsData' => $wardData
        ]);
    }

    public function taxPayer()
    {
        $fiscalYears = FiscalYear::all();
        $taxPayerTypes = TaxPayerType::all();
        return view('revenue::admin.report.tax-payer', compact('fiscalYears', 'taxPayerTypes'));
    }

    public function taxPayerReport(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'to_date' => ['nullable'],
            'tax_payer_type' => ['nullable', 'array'],
            'tax_payer_type.*' => [Rule::exists('tax_payer_types', 'id')],
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')],
        ]);
        $taxPayerTypes = TaxPayerType::with(['taxPayer' => function ($query) use ($request) {
            $this->filterDataFromUser($query, $request);
        }])->where(function ($query) use ($request) {
            if (!empty($request->input('tax_payer_type'))) {
                $query->whereIn('id', $request->input('tax_payer_type'));
            }
        })
            ->get()->map(function ($taxPayerType) {
                return [
                    'title' => $taxPayerType->title,
                    'total' => $taxPayerType->taxPayer->count()
                ];
            });
        return response()->json([
            'fiscal_years' => !empty($request->input('fiscal_year')) ? FiscalYear::select('title')->whereIn('id', Arr::wrap($request->input('fiscal_year')))->pluck('title') : FiscalYear::pluck('title'),
            'view' => (string)View::make('revenue::admin.report.inc.tax-payer', compact('taxPayerTypes'))
        ]);
    }

    public function wordWiseInvoice()
    {
        $fiscalYears = FiscalYear::all();
        return \view('revenue::admin.report.ward-wise-invoice', compact('fiscalYears'));
    }

    public function wordWiseInvoiceReport(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'to_date' => ['nullable'],
            'tax_payer_type' => ['nullable', 'array'],
            'tax_payer_type.*' => [Rule::exists('tax_payer_types', 'id')],
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')],
        ]);

        $invoices = Invoice::with('InvoiceParticulars')->where(function ($query) use ($request) {
            $this->filterDataFromUser($query, $request);
        })->get()->map(function ($invoice) {
            return [
                'ward' => $invoice->ward,
                'invoice' => $invoice->is_cash_invoice,
                'grand_total_amount' => $invoice->InvoiceParticulars->sum('grand_total_amount')
            ];
        });
        $data = collect();

        foreach (officeSetting()->localBody->ward_no as $ward_no) {
            $data->push([
                'ward' => 'वडा नं ' . $ward_no,
                'land_invoice' => $invoices->where('ward', $ward_no)->where('invoice', 0)->sum('grand_total_amount'),
                'invoice' => $invoices->where('ward', $ward_no)->where('invoice', 1)->sum('grand_total_amount'),
                'total' => $invoices->where('ward', $ward_no)->where('invoice', 0)->sum('grand_total_amount') + $invoices->where('ward', $ward_no)->where('invoice', 1)->sum('grand_total_amount'),
            ]);
        }
        return response()->json([
            'data' => $data,
            'view' => (string)View::make('revenue::admin.report.inc.ward-wise-invoice', compact('data'))
        ]);
    }
}

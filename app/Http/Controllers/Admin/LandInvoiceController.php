<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings\FiscalYear;
use Illuminate\Support\Facades\DB;
use Modules\Revenue\Entities\Invoice;
use Modules\Revenue\Entities\InvoiceParticular;
use Modules\Revenue\Entities\TaxPayer;
use Modules\Revenue\Http\Requests\Invoice\StoreInvoiceRequest;
use Modules\Revenue\Http\Requests\Invoice\UpdateInvoiceRequest;

class LandInvoiceController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('invoice_access');

        $invoices = Invoice::withSum(['invoiceParticulars' => function ($query) {
            $query->select(DB::raw('SUM((rate * quantity) + (rate * quantity) * due + fine) as total'));
        }], 'total')
            ->where('fiscal_year_id', officeSetting()->fiscal_year_id)
            ->landInvoice()
            ->latest('payment_date_en')
            ->paginate(25);

        return view('revenue::admin.land-invoice.index', compact('invoices'));
    }

    public function create()
    {
        $this->checkAuthorization('invoice_create');
        $taxPayers = TaxPayer::latest()->get();
        $fiscalYears = FiscalYear::latest()->get();
        return view('revenue::admin.land-invoice.create', compact('taxPayers', 'fiscalYears'));
    }

    public function store(StoreInvoiceRequest $request)
    {
        $this->checkAuthorization('invoice_create');

        DB::transaction(function () use ($request) {
            $invoice = Invoice::create($request->validated() + ['is_cash_invoice' => 0]);

            foreach ($request->input('particulars') as $particular) {
                $invoice->invoiceParticulars()->create($particular);
            }
        });

        toast('मालपोत रसिद सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(Invoice $invoice)
    {
        $this->checkAuthorization('invoice_access');
        $invoice->load('invoiceParticulars', 'taxPayer', 'user', 'fiscalYear');


        $invoice->loadSum(['invoiceParticulars' => function ($query) {
            $query->select(DB::raw('SUM((rate * quantity) + (rate * quantity) * due + fine) as total'));
        }], 'total');

        $invoice->loadSum('invoiceParticulars', 'fine');

        return view('revenue::admin.invoice.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $this->checkAuthorization('invoice_edit');

        $invoice->load('invoiceParticulars');

        $taxPayers = TaxPayer::latest()->get();
        $fiscalYears = FiscalYear::latest()->get();
        return view('revenue::admin.land-invoice.edit', compact('invoice', 'taxPayers', 'fiscalYears'));
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $this->checkAuthorization('invoice_edit');

        DB::transaction(function () use ($request, $invoice) {
            $invoice->update($request->validated());
            $ids = collect();

            foreach ($request->input('particulars') as $particular) {
                $invoiceParticular = InvoiceParticular::updateOrCreate([
                    'invoice_id' => $invoice->id,
                    'id' => $particular['id'] ?? null,
                ], \Arr::except($particular, ['id']));

                $ids->push($invoiceParticular->id);
            }

            $invoice->invoiceParticulars()->whereNotIn('id', $ids)->delete();
        });

        toast('मालपोत रसिद सफलतापूर्वक सम्पादन भयो', 'success');
        return redirect()->route('admin.revenue.land.invoice.index');
    }

    public function destroy(Invoice $invoice)
    {
        $this->checkAuthorization('invoice_delete');

        $invoice->delete();
        toast('मालपोत रसिद सफलतापूर्वक हटाइयो', 'success');
        return redirect()->route('admin.revenue.land.invoice.index');
    }
}

<?php

namespace Modules\Revenue\Observers;

use App\Models\Settings\FiscalYear;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Revenue\Entities\Invoice;

class InvoiceObserver
{
    public function creating(Invoice $invoice): void
    {
        if (!empty($invoice->fiscal_year_id)) {
            $fiscal_year = FiscalYear::find($invoice->fiscal_year_id)->title;
        } else {
            $fiscal_year = officeSetting()->fiscalyear->title;
        }

        $invoice->name = $invoice->taxPayer->name ?? '';
        $invoice->address = $invoice->address ?? $invoice->taxPayer->address;
        $invoice->user_id = auth()->id();
        $invoice->invoice_no = $this->generateUniqueId(fiscalYear: $fiscal_year);
    }

    public function updating(Invoice $invoice): void
    {
        if ($invoice->isDirty('tax_payer_id')) {
            $invoice->name = $invoice->taxPayer->name ?? '';
            $invoice->address = $invoice->address ?? $invoice->taxPayer->address;
        }
    }

    private function generateUniqueId($fiscalYear, $table = 'invoices', $code = 'REV'): string
    {
        generateUniqueId:
        $unique_id = $code . '-' . $fiscalYear . '-' . Str::padLeft(random_int(1, 999999), 6, 0);
        if (DB::table($table)->where('invoice_no', $unique_id)->count() > 0) {
            goto generateUniqueId;
        }

        return $unique_id;
    }
}

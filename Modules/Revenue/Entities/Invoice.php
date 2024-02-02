<?php

namespace Modules\Revenue\Entities;

use App\Models\Settings\FiscalYear;
use App\Models\User;
use App\Traits\GetAllColumns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;
    use GetAllColumns;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'payment_date_en',
    ];

    protected $fillable = [
        'invoice_no',
        'tax_payer_id',
        'fiscal_year_id',
        'user_id',
        'name',
        'address',
        'payment_method',
        'reference_code',
        'payment_date',
        'payment_date_en',
        'ward',
        'remarks',
        'invoice_copy',
        'is_cash_invoice'
    ];

    public function taxPayer(): BelongsTo
    {
        return $this->belongsTo(TaxPayer::class);
    }

    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function InvoiceParticulars(): HasMany
    {
        return $this->hasMany(InvoiceParticular::class);
    }

    public function scopeCashInvoice($query)
    {
        return $query->where('is_cash_invoice', 1);
    }
    public function scopeLandInvoice($query)
    {
        return $query->where('is_cash_invoice', 0);
    }
}

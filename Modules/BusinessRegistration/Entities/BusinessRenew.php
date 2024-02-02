<?php

namespace Modules\BusinessRegistration\Entities;

use App\Models\Settings\FiscalYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class BusinessRenew extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'fiscal_year_id',
        'business_detail_id',
        'business_renew_date',
        'business_renew_date_en',
        'date_to_be_maintained',
        'date_to_be_maintained_en',
        'renew_amount',
        'penalty_amount',
        'payment_receipt',
        'payment_receipt_date',
        'payment_receipt_date_en',
        'reg_no',
        'registration_no'

    ];

    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function businessDetail(): BelongsTo
    {
        return $this->belongsTo(BusinessDetail::class);
    }
}

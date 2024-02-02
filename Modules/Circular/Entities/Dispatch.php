<?php

namespace Modules\Circular\Entities;

use App\Models\Settings\FiscalYear;
use App\Traits\EventObserveTrait;
use App\Traits\GetAllColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Dispatch extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;
    use GetAllColumns;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'fiscal_year_id',
        'dispatch_no',
        'prefix',
        'dispatch_date',
        'en_dispatch_date',
        'letter_number',
        'letter_date',
        'en_letter_date',
        'subject',
        'receiver_name',
        'receiver_address',
        'receiver_contact',
        'remarks',
    ];

    protected $appends = [
        'dispatch_month',
        'dispatch_number',
    ];

    public function getReceiverSignatureUrlAttribute(): string
    {
        return $this->attributes['receiver_signature']
            ? Storage::disk('public')->url($this->attributes['receiver_signature'])
            : '';
    }

    public function setReceiverSignatureAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['receiver_signature'] = $value->store('dispatch/signature/'.Str::slug($this->attributes['receiver_name'], '_'), 'public');
        }
    }

    public function getDispatchMonthAttribute(): string
    {
        return explode('-', $this->dispatch_date)[1] ?? '';
    }
    public function getDispatchNumberAttribute(): string
    {
        return $this->attributes['prefix']. Str::padLeft($this->attributes['dispatch_no'], 4, 0);
    }

    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function dispatchDetail(): HasOne
    {
        return $this->hasOne(DispatchDetail::class);
    }

    public function setting()
    {
        return $this->belongsTo(CircularSetting::class);
    }
}

<?php

namespace Modules\Identity\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class DisabilityPrint extends Model
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
        'disability_identity_card_id',
        'title',
        'date',
        'date_ad',
        'employee_signature_id'
    ];

    public function disabilityIdentityCard(): BelongsTo
    {
        return $this->belongsTo(DisabilityIdentityCard::class);
    }

    public function employeeSignature(): BelongsTo
    {
        return $this->belongsTo(EmployeeSignature::class);
    }
}

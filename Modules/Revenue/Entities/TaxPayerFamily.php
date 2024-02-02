<?php

namespace Modules\Revenue\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class TaxPayerFamily extends Model
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
        'tax_payer_id',
        'name',
        'relation',
    ];

    public function taxPayer(): BelongsTo
    {
        return $this->belongsTo(TaxPayer::class);
    }
}

<?php

namespace Modules\Identity\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IdentityRecord extends Model
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
        'print_date',
        'print_date_en',
        'old_print_date',
        'old_print_date_en'
    ];

    public function disabilityIdentityCards(): BelongsTo
    {
        return $this->belongsTo(DisabilityIdentityCard::class);
    }
}

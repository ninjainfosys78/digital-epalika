<?php

namespace Modules\Revenue\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class TaxPayerLand extends Model
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
        'user_id',
        'tax_payer_id',
        'plot_no',
        'former_ward',
        'former_vdc',
        'ward_no',
        'area',
        'sector_id',
        'place_id',
        'land_address',
        'land_use',
        'remarks',
    ];

    protected $appends = [
        'current_rate'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function taxPayer(): BelongsTo
    {
        return $this->belongsTo(TaxPayer::class);
    }


    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function getCurrentRateAttribute(): float|int
    {
        return round(($this->place->rate ?? 0) * ($this->attributes['area'] ?? 0), 2);
    }
}

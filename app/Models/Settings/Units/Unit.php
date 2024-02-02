<?php

namespace App\Models\Settings\Units;

use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type_id',
        'measurement_unit_id',
        'title',
        'title_en',
        'notation',
        'notation_ne',
        'position',
        'is_smallest',
    ];

    public function measurementUnit(): BelongsTo
    {
        return $this->belongsTo(MeasurementUnit::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function conversionUnitFrom(): HasMany
    {
        return $this->hasMany(UnitConversion::class, 'conversion_from');
    }

    public function conversionUnitTo(): HasOne
    {
        return $this->hasOne(UnitConversion::class, 'conversion_to');
    }
}

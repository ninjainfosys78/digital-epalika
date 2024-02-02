<?php

namespace Modules\EMap\Entities;

use App\Models\Settings\Units\Type;
use App\Models\Settings\Units\Unit;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class MapSetting extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'thumbnail',
        'document',
        'map_request_form_format',
        'land_measurement_id',
        'land_measurement_standard_id',
        'muchulka_after_complietion',
        'muchulka_before_complietion'
    ];

    public function landMeasurement(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'land_measurement_id');
    }

    public function standardLandMeasurement(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'land_measurement_standard_id');
    }

    protected function thumbnail(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => $value ? Storage::disk('public')->url($value) : '',
            set: static fn ($value) => (!empty($value) && !is_string($value)) ? $value->store('mapSetting/', 'public') : null,
        );
    }

    protected function document(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => $value ? Storage::disk('public')->url($value) : '',
            set: static fn ($value) => (!empty($value) && !is_string($value)) ? $value->store('mapSetting/', 'public') : null,
        );
    }
}

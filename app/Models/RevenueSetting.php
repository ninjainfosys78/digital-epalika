<?php

namespace App\Models;

use App\Models\Settings\Units\Type;
use App\Models\Settings\Units\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class RevenueSetting extends Model
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
        'invoice_no_prefix',
        'land_measurement_id',
        'land_measurement_standard_id',
    ];


    public function landMeasurement(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'land_measurement_id');
    }

    public function standardLandMeasurement(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'land_measurement_standard_id');
    }
}

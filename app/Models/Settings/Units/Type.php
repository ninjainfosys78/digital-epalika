<?php

namespace App\Models\Settings\Units;

use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
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
        'title',
    ];

    public function measurementUnit(): HasMany
    {
        return $this->hasMany(MeasurementUnit::class);
    }

    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }
}

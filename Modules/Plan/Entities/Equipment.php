<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class Equipment extends Model
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
        'title',
        'activity',
        'is_used_for_transport',
        'capacity',
        'speed_with_out_load',
    ];

    public function equipmentAdditionalCosts()
    {
        return $this->hasMany(EquipmentAdditionalCost::class);
    }

    public function fuelDemands()
    {
        return $this->hasMany(FuelDemand::class);
    }
    public function crewRates()
    {
        return $this->hasMany(CrewRate::class);
    }
}

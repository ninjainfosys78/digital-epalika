<?php

namespace Modules\Plan\Entities;

use App\Models\Settings\FiscalYear;
use App\Models\Settings\Units\Unit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class EquipmentAdditionalCost extends Model
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
        'equipment_id',
        'fiscal_year_id',
        'unit_id',
        'rate',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}

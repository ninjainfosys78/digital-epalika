<?php

namespace Modules\Plan\Entities;

use App\Models\Settings\FiscalYear;
use App\Models\Settings\Units\Unit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class CargoHandling extends Model
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
        'fiscal_year_id',
        'unit_id',
        'material_id',
    ];

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function collectionResources()
    {
        return $this->morphMany(CollectionResource::class, 'model');
    }
}

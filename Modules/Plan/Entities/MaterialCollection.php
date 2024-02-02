<?php

namespace Modules\Plan\Entities;

use App\Models\Settings\FiscalYear;
use App\Models\Settings\Units\Unit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class MaterialCollection extends Model
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
        'material_rate_id',
        'unit_id',
        'activity_no',
        'remarks',
        'fiscal_year_id',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function materialRate()
    {
        return $this->belongsTo(MaterialRate::class);
    }

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function collectionResources()
    {
        return $this->morphMany(CollectionResource::class, 'model');
    }
}

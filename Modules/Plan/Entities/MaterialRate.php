<?php

namespace Modules\Plan\Entities;

use App\Models\Settings\FiscalYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class MaterialRate extends Model
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
        'material_id',
        'fiscal_year_id',
        'is_vat_included',
        'is_vat_needed',
        'referance_no',
        'royalty',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class);
    }
}

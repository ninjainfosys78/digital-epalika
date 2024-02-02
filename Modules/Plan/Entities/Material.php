<?php

namespace Modules\Plan\Entities;

use App\Models\Settings\Units\Unit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class Material extends Model
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
        'material_type_id',
        'title',
        'unit_id',
        'density',
    ];

    public function materialType()
    {
        return $this->belongsTo(MaterialType::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}

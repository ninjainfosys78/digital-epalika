<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class CrewRate extends Model
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
        'labour_id',
        'equipment_id',
        'quantity',
    ];

    public function labour()
    {
        return $this->belongsTo(Labour::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}

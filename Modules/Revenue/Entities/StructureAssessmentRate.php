<?php

namespace Modules\Revenue\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class StructureAssessmentRate extends Model
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
        'sector_id',
        'physical_structure_type_id',
        'usage',
        'rate',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }

    public function physicalStructureType(): BelongsTo
    {
        return $this->belongsTo(PhysicalStructureType::class);
    }
}

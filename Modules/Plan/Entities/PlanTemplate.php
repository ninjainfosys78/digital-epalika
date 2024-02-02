<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Modules\Plan\Enums\PlanTemplateTypeEnum;
use Modules\Plan\Enums\ProjectOperatedThroughEnum;

class PlanTemplate extends Model
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
        'type',
        'template_for',
        'title',
        'data'
    ];

    protected $casts = [
        'type' => PlanTemplateTypeEnum::class,
        'template_for' => ProjectOperatedThroughEnum::class
    ];
}

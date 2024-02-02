<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Modules\Plan\Enums\GrantSourceEnum;

class ProjectGrantDetail extends Model
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
        'project_id',
        'grant_source',
        'asset_name',
        'quantity',
        'asset_unit'
    ];

    protected $casts = [
        'grant_source' => GrantSourceEnum::class
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}

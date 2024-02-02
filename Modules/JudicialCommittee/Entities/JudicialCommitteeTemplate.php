<?php

namespace Modules\JudicialCommittee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Modules\JudicialCommittee\Enums\JudicialTemplateTypeEnum;

class JudicialCommitteeTemplate extends Model
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
        'title',
        'data',
    ];

    protected $casts = [
        'type' => JudicialTemplateTypeEnum::class
    ];
}

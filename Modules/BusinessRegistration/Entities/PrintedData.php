<?php

namespace Modules\BusinessRegistration\Entities;

use App\Models\File;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\BusinessRegistration\Enums\TemplateTypeEnum;

class PrintedData extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'business_detail_id',
        'data',
        'for',
    ];

    protected $casts = [
        'for' => TemplateTypeEnum::class,
    ];

    public function proprietorDetail(): BelongsTo
    {
        return $this->belongsTo(ProprietorDetail::class);
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'model');
    }
}

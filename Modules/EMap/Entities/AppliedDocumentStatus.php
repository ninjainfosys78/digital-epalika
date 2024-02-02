<?php

namespace Modules\EMap\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Modules\EMap\Enums\DocumentStatusEnum;

class AppliedDocumentStatus extends Model
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
        "applied_document_id",
        "status",
        "comment",
    ];

    protected $casts = [
        'status' => DocumentStatusEnum::class
    ];

    public function appliedDocument(): BelongsTo
    {
        return $this->belongsTo(AppliedDocument::class);
    }

    public function appliedMapFiles(): MorphMany
    {
        return $this->morphMany(AppliedMapFile::class, 'fileable');
    }
}

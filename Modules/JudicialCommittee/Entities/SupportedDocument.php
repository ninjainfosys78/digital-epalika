<?php

namespace Modules\JudicialCommittee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Support\Facades\Storage;
use Modules\JudicialCommittee\Enums\ComplainantDefendantTypeEnum;

class SupportedDocument extends Model
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
        'complaint_application_id',
        'type',
        'document_name',
        'document'
    ];

    protected $casts = [
        'type' => ComplainantDefendantTypeEnum::class
    ];

    public function getDocumentUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->document);
    }

    public function setDocumentAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['document'] = $value->store('judicial_committee/supported_documents', 'public');
        }
    }

    public function getExtensionAttribute(): array|string
    {
        return pathinfo($this->document, PATHINFO_EXTENSION);
    }

    public function complaintApplication(): BelongsTo
    {
        return $this->belongsTo(ComplaintApplication::class);
    }
}

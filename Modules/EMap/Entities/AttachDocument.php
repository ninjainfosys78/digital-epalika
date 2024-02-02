<?php

namespace Modules\EMap\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class AttachDocument extends Model
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
        'map_apply_id',
        'land_owner_document',
        'land_revenue_document',
        'land_owner_citizenship',
        'blue_print',
        'pass_document',
        'designer_document',
        'permission_document',
        'inheritance_document',
        'analysis_document',
        'land_owner_document_status',
        'land_revenue_document_status',
        'land_owner_citizenship_status',
        'blue_print_status',
        'pass_document_status',
        'designer_document_status',
        'permission_document_status',
        'inheritance_document_status',
        'analysis_document_status',
    ];

    public function mapApply(): BelongsTo
    {
        return $this->belongsTo(MapApply::class);
    }


    protected function landOwnerDocument(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => $value ? Storage::disk('public')->url($value) : '',
            set: static fn ($value) => (!empty($value) && !is_string($value)) ? $value->store('attachDocument', 'public') : null,
        );
    }
    protected function landRevenueDocument(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => $value ? Storage::disk('public')->url($value) : '',
            set: static fn ($value) => (!empty($value) && !is_string($value)) ? $value->store('attachDocument', 'public') : null,
        );
    }
    protected function landOwnerCitizenship(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => $value ? Storage::disk('public')->url($value) : '',
            set: static fn ($value) => (!empty($value) && !is_string($value)) ? $value->store('attachDocument', 'public') : null,
        );
    }
    protected function bluePrint(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => $value ? Storage::disk('public')->url($value) : '',
            set: static fn ($value) => (!empty($value) && !is_string($value)) ? $value->store('attachDocument', 'public') : null,
        );
    }
    protected function passDocument(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => $value ? Storage::disk('public')->url($value) : '',
            set: static fn ($value) => (!empty($value) && !is_string($value)) ? $value->store('attachDocument', 'public') : null,
        );
    }
    protected function designerDocument(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => $value ? Storage::disk('public')->url($value) : '',
            set: static fn ($value) => (!empty($value) && !is_string($value)) ? $value->store('attachDocument', 'public') : null,
        );
    }
    protected function permissionDocument(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => $value ? Storage::disk('public')->url($value) : '',
            set: static fn ($value) => (!empty($value) && !is_string($value)) ? $value->store('attachDocument', 'public') : null,
        );
    }
    protected function inheritanceDocument(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => $value ? Storage::disk('public')->url($value) : '',
            set: static fn ($value) => (!empty($value) && !is_string($value)) ? $value->store('attachDocument', 'public') : null,
        );
    }

    protected function analysisDocument(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => $value ? Storage::disk('public')->url($value) : '',
            set: static fn ($value) => (!empty($value) && !is_string($value)) ? $value->store('attachDocument', 'public') : null,
        );
    }

    public function getLandOwnerDocumentSizeAttribute(): string
    {
        return Storage::disk('public')->size($this->attributes['land_owner_document']);
    }

    public function getLandRevenueDocumentSizeAttribute(): string
    {
        return Storage::disk('public')->size($this->attributes['land_revenue_document']);
    }

    public function getLandOwnerCitizenshipSizeAttribute(): string
    {
        return Storage::disk('public')->size($this->attributes['land_owner_citizenship']);
    }

    public function getBluePrintSizeAttribute(): string
    {
        return Storage::disk('public')->size($this->attributes['blue_print']);
    }

    public function getPassDocumentSizeAttribute(): string
    {
        return Storage::disk('public')->size($this->attributes['pass_document']);
    }

    public function getDesignerDocumentSizeAttribute(): string
    {
        return Storage::disk('public')->size($this->attributes['designer_document']);
    }

    public function getPermissionDocumentSizeAttribute(): string
    {
        return Storage::disk('public')->size($this->attributes['permission_document']);
    }

    public function getInheritanceDocumentSizeAttribute(): string
    {
        return Storage::disk('public')->size($this->attributes['inheritance_document']);
    }
    public function getAnalysisDocumentSizeAttribute(): string
    {
        $filePath = $this->attributes['analysis_document'];

        if (!empty($filePath)) {
            return Storage::disk('public')->size($filePath);
        }
        return 'File path is empty';
    }
}

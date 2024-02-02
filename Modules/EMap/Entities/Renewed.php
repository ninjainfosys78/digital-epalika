<?php

namespace Modules\EMap\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Renewed extends Model
{
    use HasFactory,SoftDeletes,EventObserveTrait;

   protected $dates = [
       'created_at',
       'updated_at',
       'deleted_at'
   ];

   protected $fillable = [

    'organization_detail_id',
    'document',
    'year'
   ];

   public function organizationDetail(): BelongsTo
    {
        return $this->belongsTo(OrganizationDetail::class);
    }

    public function getDocumentUrlAttribute(): string
    {
        return $this->attributes['document']
            ? Storage::disk('public')->url($this->attributes['document'])
            : asset('images/user_icon.jpg');
    }

    public function setDocumentAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['document'] = $value->store('user/detail/org/renewed', 'public');
        }
    }

    
}


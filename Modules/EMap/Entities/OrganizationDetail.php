<?php

namespace Modules\EMap\Entities;

use App\Models\Address\District;
use App\Models\Address\LocalBody;
use App\Models\Address\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrganizationDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'org_name_ne',
        'org_name_en',
        'org_email',
        'org_contact',
        'org_registration_no',
        'org_registration_document',
        'org_pan_no',
        'org_pan_document',
        'logo',
        'province_id',
        'district_id',
        'local_body_id',
        'ward',
        'tole',
        'organization_id',
    ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function localBody(): BelongsTo
    {
        return $this->belongsTo(LocalBody::class, 'local_body_id');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function taxClearances(): HasMany
    {
        return $this->hasMany(TaxClearance::class);
    }

    public function reneweds(): HasMany
    {
        return $this->hasMany(Renewed::class);
    }

    public function emapMuncipalRegistrations(): HasMany
    {
        return $this->hasMany(EmapMuncipalRegistration::class);
    }

    public function getOrgRegistrationDocumentUrlAttribute(): string
    {
        return $this->attributes['org_registration_document']
            ? Storage::disk('public')->url($this->attributes['org_registration_document'])
            : asset('images/user_icon.jpg');
    }

    public function setOrgRegistrationDocumentAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['org_registration_document'] = $value->store('user/detail/org/' . Str::slug($this->attributes['org_name_en'], '_'), 'public');
        }
    }

    public function getOrgPanDocumentUrlAttribute(): string
    {
        return $this->attributes['org_pan_document']
            ? Storage::disk('public')->url($this->attributes['org_pan_document'])
            : asset('images/user_icon.jpg');
    }

    public function setOrgPanDocumentAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['org_pan_document'] = $value->store('user/detail/org/' . Str::slug($this->attributes['org_name_en'], '_'), 'public');
        }
    }

    public function getLogoUrlAttribute(): string
    {
        return $this->attributes['logo']
            ? Storage::disk('public')->url($this->attributes['logo'])
            : asset('images/user_icon.jpg');
    }

    public function setLogoAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['logo'] = $value->store('user/detail/org/' . Str::slug($this->attributes['org_name_en'], '_'), 'public');
        }
    }
}

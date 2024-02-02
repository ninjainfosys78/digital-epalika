<?php

namespace Modules\EMap\Entities;

use App\Enums\Gender;
use App\Enums\MaritalStatusEnum;
use App\Models\Address\District;
use App\Models\Address\LocalBody;
use App\Models\Address\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name_ne',
        'name_en',
        'email',
        'phone',
        'gender',
        'marital_status',
        'father_name',
        'grandfather_name',
        'pan_no',
        'nec_no',
        'nec_certificate',
        'citizenship_no',
        'citizenship_issued_district',
        'citizenship_issued_date',
        'citizenship_front',
        'citizenship_back',
        'permanent_province_id',
        'permanent_district_id',
        'permanent_local_body_id',
        'permanent_ward',
        'permanent_tole',
        'temporary_province_id',
        'temporary_district_id',
        'temporary_local_body_id',
        'temporary_ward',
        'temporary_tole',
        'organization_id',
    ];

    protected $casts = [
        'gender' => Gender::class,
        'marital_status' => MaritalStatusEnum::class,
    ];

    public function getNecCertificateUrlAttribute(): string
    {
        return $this->attributes['nec_certificate']
            ? Storage::disk('public')->url($this->attributes['nec_certificate'])
            : asset('images/user_icon.jpg');
    }

    public function setNecCertificateAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['nec_certificate'] = $value->store('user/detail/'.Str::slug($this->attributes['name_ne'], '_'), 'public');
        }
    }

    public function getCitizenshipFrontUrlAttribute(): string
    {
        return $this->attributes['citizenship_front']
            ? Storage::disk('public')->url($this->attributes['citizenship_front'])
            : asset('images/user_icon.jpg');
    }

    public function setCitizenshipFrontAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['citizenship_front'] = $value->store('user/detail/'.Str::slug($this->attributes['name_ne'], '_'), 'public');
        }
    }

    public function getCitizenshipBackUrlAttribute(): string
    {
        return $this->attributes['citizenship_back']
            ? Storage::disk('public')->url($this->attributes['citizenship_back'])
            : asset('images/user_icon.jpg');
    }

    public function setCitizenshipBackAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['citizenship_back'] = $value->store('user/detail/'.Str::slug($this->attributes['name_ne'], '_'), 'public');
        }
    }

    public function citizenshipIssuedDistrict(): BelongsTo
    {
        return $this->belongsTo(District::class, 'citizenship_issued_district');
    }

    public function permanentProvince(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'permanent_province_id');
    }

    public function permanentDistrict(): BelongsTo
    {
        return $this->belongsTo(District::class, 'permanent_district_id');
    }

    public function permanentLocalBody(): BelongsTo
    {
        return $this->belongsTo(LocalBody::class, 'permanent_local_body_id');
    }

    public function temporaryProvince(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'temporary_province_id');
    }

    public function temporaryDistrict(): BelongsTo
    {
        return $this->belongsTo(District::class, 'temporary_district_id');
    }

    public function temporaryLocalBody(): BelongsTo
    {
        return $this->belongsTo(LocalBody::class, 'temporary_local_body_id');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}

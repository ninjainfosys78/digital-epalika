<?php

namespace Modules\Identity\Entities;

use App\Enums\BloodGroupEnum;
use App\Enums\Gender;
use App\Enums\StatusEnum;
use App\Models\Address\District;
use App\Models\Address\LocalBody;
use App\Models\Address\Province;
use App\Models\Settings\FiscalYear;
use App\Models\Settings\Relationship;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Modules\BusinessRegistration\Enums\Qualification;
use Modules\Identity\Traits\IdentityRecommendationTemplateTrait;

class DisabilityIdentityCard extends Model
{
    use SoftDeletes;
    use EventObserveTrait;
    use IdentityRecommendationTemplateTrait;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        "first_print_at",
        "latest_print_at"
    ];

    protected $fillable = [
        'name',
        'name_en',
        'citizenship_no',
        'birth_registration_no',
        'doctor_name',
        'identity_no',
        'father_name',
        'father_name_en',
        'mother_name',
        'mother_name_en',
        'dob',
        'dob_ad',
        'gender',
        "blood_group",
        "number",
        "card_no",
        'print_count',
        "fiscal_year_id",
        'province_id',
        'district_id',
        'local_body_id',
        'ward_no',
        'tole',
        'photo',
        'guardian_name',
        'guardian_name_en',
        'relationship_id',
        'phone',
        'is_full_detail_required',
        'disability_type_id',
        'hospital_id',
        'gov_disability_type_id',
        'status',
        'recommend_at',
        "disability_reason_id",
        "citizenship_no_place",
        "citizenship_date_ad",
        "citizenship_date",
        "document_photo",
        "document_photo_back",
        "material_description",
        "qualification",
        "daily_activity",
        "supporting_material",
        "helping_task",
        "without_helping_task",
        "main_training_name",
        "occupation_id",
        "employee_signature_id",
        "first_print_at",
        "latest_print_at"

    ];

    protected $casts = [
        'gender' => Gender::class,
        'status' => StatusEnum::class,
        'qualification' => Qualification::class,
        'blood_group' => BloodGroupEnum::class,
    ];

    protected function helpingTask(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => $value ? explode(',', $value) : [],
            set: static fn ($value) => implode(',', $value),
        );
    }

    protected function withoutHelpingTask(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => $value ? explode(',', $value) : [],
            set: static fn ($value) => implode(',', $value),
        );
    }

    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function localBody(): BelongsTo
    {
        return $this->belongsTo(LocalBody::class);
    }

    public function disabilityType(): BelongsTo
    {
        return $this->belongsTo(DisabilityType::class);
    }

    public function governmentalDisabilityType(): BelongsTo
    {
        return $this->belongsTo(GovernmentalDisabilityType::class, 'gov_disability_type_id');
    }

    public function relationship(): BelongsTo
    {
        return $this->belongsTo(Relationship::class);
    }

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }
    public function employeeSignature(): BelongsTo
    {
        return $this->belongsTo(EmployeeSignature::class);
    }

    public function setPhotoAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['photo'] = $value->store('disabilityIdentityCard', 'public');
        }
    }

    public function getPhotoUrlAttribute(): string|null
    {
        return $this->attributes['photo']
            ? Storage::disk('public')->url($this->attributes['photo'])
            : '';
    }

    public function getCanEditDeleteAttribute(): bool
    {
        return (auth()->user()->role->type === 'Super' || auth()->id() == $this->user_id);
    }

    public function setDocumentPhotoAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['document_photo'] = $value->store('disabilityIdentityCard', 'public');
        }
    }

    public function setDocumentPhotoBackAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['document_photo_back'] = $value->store('disabilityIdentityCard', 'public');
        }
    }


    public function scopeFilterData($query)
    {
        if (auth()->user()->role->type !== 'Super') {
            $query->where('user_id', auth()->id());
            $query->orWhere('permanent_ward', auth()->user()->ward_no);
        }
        return $query;
    }

    public function identityMeeting(): BelongsToMany
    {
        return $this->belongsToMany(IdentityMeeting::class);
    }

    public function identityRecords(): HasMany
    {
        return $this->hasMany(IdentityRecord::class);
    }
}

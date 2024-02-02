<?php

namespace Modules\Roaster\Entities;

use App\Enums\Gender;
use App\Models\Address\District;
use App\Models\Address\LocalBody;
use App\Models\Address\Province;
use App\Models\Ethnicity;
use App\Models\MobileUser;
use App\Models\Settings\Department;
use App\Models\Settings\Designation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Trainee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'full_name',
        'province_id',
        'district_id',
        'local_body_id',
        'training_id',
        'ward_no',
        'tole',
        'citizenship_no',
        'gender',
        'ethnicity_id',
        'category',
        'phone_no',
        'email_id',
        'qualification',
        'current_profession',
        'farming_area',
        'photo',
        'application_form',
        'ward_recommendation',
        'mark_sheet',
        'citizenship_front',
        'citizenship_back',
        'passport',
        'visa',
        'other_training',
        'select',
        'reference_id',
        'is_employee',
        'designation_id',
        'department_id',
        'service_time',
        'office_name',
        'office_address',
        'office_phone',
        'office_email',
        'nomination_letter',
        'recommendation_letter',
        'mobile_user_id'

    ];

    protected $casts = [
        'gender' => Gender::class,
    ];

    public function setPhotoAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['photo'] = $value->store('trainee/' . Str::slug($this->attributes['full_name'], '_'), 'public');
        }
    }

    public function getPhotoUrlAttribute(): string
    {
        return $this->attributes['photo'] ? asset('storage/' . $this->attributes['photo']) : asset('images/user_icon.jpg');
    }

    public function setApplicationFormAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['application_form'] = $value->store('trainee/' . Str::slug($this->attributes['full_name'], '_'), 'public');
        }
    }

    public function getApplicationFormAttribute(): string
    {
        return asset('storage/' . $this->attributes['application_form']);
    }

    public function setWardRecommendationAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['ward_recommendation'] = $value->store('trainee/' . Str::slug($this->attributes['full_name'], '_'), 'public');
        }
    }

    public function getWardRecommendationAttribute(): string
    {
        return asset('storage/' . $this->attributes['ward_recommendation']);
    }

    public function setMarkSheetAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['mark_sheet'] = $value->store('trainee/' . Str::slug($this->attributes['full_name'], '_'), 'public');
        }
    }

    public function getMarkSheetAttribute(): string
    {
        return asset('storage/' . $this->attributes['mark_sheet']);
    }

    public function setCitizenshipFrontAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['citizenship_front'] = $value->store('trainee/' . Str::slug($this->attributes['full_name'], '_'), 'public');
        }
    }

    public function getCitizenshipFrontAttribute(): string
    {
        return asset('storage/' . $this->attributes['citizenship_front']);
    }

    public function setCitizenshipBackAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['citizenship_back'] = $value->store('trainee/' . Str::slug($this->attributes['full_name'], '_'), 'public');
        }
    }

    public function getCitizenshipBackAttribute(): string
    {
        return asset('storage/' . $this->attributes['citizenship_back']);
    }

    public function setPassportAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['passport'] = $value->store('trainee/' . Str::slug($this->attributes['full_name'], '_'), 'public');
        }
    }

    public function getPassportAttribute(): string
    {
        return asset('storage/' . $this->attributes['passport']);
    }

    public function setNominationLetterAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['nomination_letter'] = $value->store('trainee/' . Str::slug($this->attributes['full_name'], '_'), 'public');
        }
    }

    public function getNominationLetterAttribute(): string
    {
        return asset('storage/' . $this->attributes['nomination_letter']);
    }

    public function setRecommendationLetterAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['recommendation_letter'] = $value->store('trainee/' . Str::slug($this->attributes['full_name'], '_'), 'public');
        }
    }

    public function getRecommendationLetterAttribute(): string
    {
        return asset('storage/' . $this->attributes['recommendation_letter']);
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'model');
    }

    public function trainingTrainee(): MorphOne
    {
        return $this->morphOne(TrainingTrainee::class, 'model');
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function LocalBody(): BelongsTo
    {
        return $this->belongsTo(LocalBody::class);
    }

    public function ethnicity(): BelongsTo
    {
        return $this->belongsTo(Ethnicity::class);
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'reference_id' => $this->reference_id,
        ];
    }

    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function mobileUser(): BelongsTo
    {
        return $this->belongsTo(MobileUser::class);
    }
}

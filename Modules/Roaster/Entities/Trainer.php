<?php

namespace Modules\Roaster\Entities;

use App\Models\Address\District;
use App\Models\Address\LocalBody;
use App\Models\Address\Province;
use App\Models\Settings\Department;
use App\Models\Settings\Designation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Trainer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'designation_id',
        'department_id',
        'level',
        'province_id',
        'district_id',
        'local_body_id',
        'ward',
        'tole',
        'office',
        'appointment_date',
        'phone',
        'email',
        'photo',
        'pan',
        'experience',
        'qualification',
        'bank_detail',
        'experience_as_trainee',
        'experience_as_trainer',
    ];

    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
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

    public function getPhotoUrlAttribute(): string
    {
        return $this->attributes['photo']
            ? Storage::disk('public')->url($this->attributes['photo'])
            : asset('images/user_icon.png');
    }

    public function setPhotoAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['photo'] = $value->store('trainer/'.Str::slug($this->attributes['name'], '_'), 'public');
        }
    }

    public function trainerExperiences(): HasMany
    {
        return $this->hasMany(TrainerExperience::class);
    }

    public function trainerQualifications(): HasMany
    {
        return $this->hasMany(TrainerQualification::class);
    }

    public function trainerExperienceAsTrainees(): HasMany
    {
        return $this->hasMany(TrainerExperienceAsTrainee::class);
    }

    public function trainerExperienceInTrainings(): HasMany
    {
        return $this->hasMany(TrainerExperienceInTraining::class);
    }

    public function trainerBankDetails(): HasMany
    {
        return $this->hasMany(TrainerBankDetail::class);
    }

    public function trainerDocuments(): HasMany
    {
        return $this->hasMany(TrainerDocument::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }

    public function User(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function trainings(): BelongsToMany
    {
        return $this->belongsToMany(Training::class);
    }
}

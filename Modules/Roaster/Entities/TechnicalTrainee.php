<?php

namespace Modules\Roaster\Entities;

use App\Models\Address\District;
use App\Models\Address\LocalBody;
use App\Models\Address\Province;
use App\Models\Ethnicity;
use App\Models\Settings\Department;
use App\Models\Settings\Designation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TechnicalTrainee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'employee_name',
        'photo',
        'designation_id',
        'department_id',
        'service_time',
        'label',
        'education_qualification',
        'province_id',
        'district_id',
        'local_body_id',
        'ward_no',
        'tole',
        'contact_no',
        'email',
        'responsibility',
        'training',
        'hobby',
        'excellence',
        'learning_subject',
        'expectation',
        'office_name',
        'office_address',
        'office_phone',
        'office_email',
        'nomination_letter',
        'recommendation_letter',
        'select',
        'reference_id',
    ];

    public function setPhotoAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['photo'] = $value->store('technical_trainee/'.Str::slug($this->attributes['employee_name'], '_'), 'public');
        }
    }

    public function setNominationLetterAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['recommendation_letter'] = $value->store('technical_trainee/'.Str::slug($this->attributes['employee_name'], '_'), 'public');
        }
    }

    public function setRecommendationLetterAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['nomination_letter'] = $value->store('technical_trainee/'.Str::slug($this->attributes['employee_name'], '_'), 'public');
        }
    }

    public function getPhotoUrlAttribute(): string
    {
        return $this->attributes['photo'] ? asset('storage/'.$this->attributes['photo']) : asset('images/user_icon.jpg');
    }

    public function getNominationLetterUrlAttribute(): string
    {
        return Storage::url($this->attributes['nomination_letter']);
    }

    public function getRecommendationLetterUrlAttribute(): string
    {
        return Storage::url($this->attributes['recommendation_letter']);
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

    public function localBody(): BelongsTo
    {
        return $this->belongsTo(LocalBody::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class);
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'model');
    }

    public function ethnicity(): BelongsTo
    {
        return $this->belongsTo(Ethnicity::class);
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'employee_name' => $this->employee_name,
            'reference_id' => $this->reference_id,
        ];
    }
}

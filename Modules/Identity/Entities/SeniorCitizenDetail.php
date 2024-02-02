<?php

namespace Modules\Identity\Entities;

use App\Enums\BloodGroupEnum;
use App\Enums\Gender;
use App\Models\Address\District;
use App\Models\Address\LocalBody;
use App\Models\Address\Province;
use App\Models\Settings\FiscalYear;
use App\Models\User;
use App\Traits\GetAllColumns;
use App\Traits\NepaliDateConverter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Support\Facades\Storage;

class SeniorCitizenDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;
    use NepaliDateConverter;
    use GetAllColumns;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'photo',
        'name',
        'name_en',
        'dob_bs',
        'dob_ad',
        'card_no',
        'gender',
        'citizenship_no',
        'issue_date_bs',
        'spouse',
        'spouse_en',
        'blood_group',
        'father_name',
        'father_name_en',
        'mother_name_en',
        'mother_name',
        'province_id',
        'district_id',
        'local_body_id',
        'ward_no',
        'tole',
        'patrons_name',
        'patrons_name_en',
        'patrons_name_address',
        'patrons_phone',
        'patrons_relationship',
        'is_disease',
        'disease_name',
        'description',
        'description_en',
        'is_medicine',
        'medicine_name',
        'employee_signature_id',
        'user_id',
        'fiscal_year_id'
    ];

    protected $casts = [
        'gender' => Gender::class,
        'blood_group' => BloodGroupEnum::class,
    ];


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

    public function employeeSignature(): BelongsTo
    {
        return $this->belongsTo(EmployeeSignature::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fingerPrints(): MorphMany
    {
        return $this->morphMany(FingerPrint::class, 'model');
    }

    public function setPhotoAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['photo'] = $value->store('seniorCitizenship', 'public');
        } elseif (!empty($value)) {
            $this->attributes['photo'] = $value;
        }
    }

    public function getPhotoAttribute(): string
    {
        if ($this->attributes['photo']) {
            return !isBase64($this->attributes['photo'])
                ? Storage::disk('public')->url($this->attributes['photo'])
                : $this->attributes['photo'];
        } else {
            return asset('images/user_icon.jpg');
        }
    }

    public function getCanEditDeleteAttribute(): bool
    {
        return (auth()->user()->role->type === 'Super' || auth()->id() == $this->user_id);
    }


    public function scopeFilterData($query)
    {
        if (auth()->user()->role->type !== 'Super') {
            $query->where('user_id', auth()->id());
            $query->orWhere('ward_no', auth()->user()->ward_no);
        }
        return $query;
    }

    public function getAgeAttribute(): int
    {
        return Carbon::parse($this->attributes['dob_ad'])->age;
    }
}

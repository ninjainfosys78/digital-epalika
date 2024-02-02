<?php

namespace Modules\ListRegistration\Entities;

use App\Models\File;
use App\Models\Settings\FiscalYear;
use App\Traits\EventObserveTrait;
use App\Traits\GetAllColumns;
use App\Traits\NepaliDateConverter;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\ListRegistration\Enums\ApplicantCategoryEnum;
use Modules\ListRegistration\Enums\BusinessNatureEnum;

class ListRegistration extends Model
{
    use HasFactory;
    use NepaliDateConverter;
    use SoftDeletes;
    use EventObserveTrait;
    use GetAllColumns;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'fiscal_year_id',
        'registration_no',
        'applicant_type',
        'name',
        'address',
        'mailing_address',
        'main_person',
        'telephone',
        'mobile_no',
        'application_photo',
        'registration_certificate',
        'pan_photo',
        'tax_payment_certificate',
        'license_photo',
        'business_nature',
        'business_nature_description',
        'date',
        'file',
        'en_date'
    ];
    protected $appends = [
        'to_day_date'
    ];
    protected $casts = [
        'applicant_type' => ApplicantCategoryEnum::class,
        'business_nature' => BusinessNatureEnum::class
    ];

    protected function ApplicationPhoto(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?
                Storage::disk('public')->url($value)
                : '',
            set: fn ($value) => (!empty($value) && !is_string($value))
                ? $value->store('list_registration/' . Str::slug($this->attributes['main_person'], '_'), 'public')
                : null
        );
    }

    protected function RegistrationCertificate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?
                Storage::disk('public')->url($value)
                : '',
            set: fn ($value) => (!empty($value) && !is_string($value))
                ? $value->store('list_registration/' . Str::slug($this->attributes['main_person'], '_'), 'public')
                : null
        );
    }

    protected function File(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?
                Storage::disk('public')->url($value)
                : '',
            set: fn ($value) => (!empty($value) && !is_string($value))
                ? $value->store('list_registration/file/', 'public')
                : null
        );
    }

    protected function PanPhoto(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?
                Storage::disk('public')->url($value)
                : '',
            set: fn ($value) => (!empty($value) && !is_string($value))
                ? $value->store('list_registration/' . Str::slug($this->attributes['main_person'], '_'), 'public')
                : null
        );
    }

    protected function TaxPaymentCertificate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?
                Storage::disk('public')->url($value)
                : '',
            set: fn ($value) => (!empty($value) && !is_string($value))
                ? $value->store('list_registration/' . Str::slug($this->attributes['main_person'], '_'), 'public')
                : null
        );
    }

    protected function LicensePhoto(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?
                Storage::disk('public')->url($value)
                : '',
            set: fn ($value) => (!empty($value) && !is_string($value))
                ? $value->store('list_registration/' . Str::slug($this->attributes['main_person'], '_'), 'public')
                : null
        );
    }

    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'model');
    }

    public function getToDayDateAttribute(): string
    {
        return $this->get_today_nepali_date();
    }
}

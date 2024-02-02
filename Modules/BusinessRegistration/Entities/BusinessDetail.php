<?php

namespace Modules\BusinessRegistration\Entities;

use App\Models\Address\District;
use App\Models\Address\LocalBody;
use App\Models\Address\Province;
use App\Models\File;
use App\Models\MobileUser;
use App\Models\Settings\FiscalYear;
use App\Models\User;
use App\Traits\GetAllColumns;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\BusinessRegistration\Enums\BusinessTypeEnum;
use Modules\BusinessRegistration\Enums\SourceOfCapital;
use Modules\BusinessRegistration\Traits\BusinessDetailTemplateTrait;

class BusinessDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    use GetAllColumns;
    use BusinessDetailTemplateTrait;

    protected $fillable = [
        'reg_no',
        'submission_no',
        'fiscal_year_id',
        'registration_no',
        'registration_date_ne',
        'registration_date_en',
        'name',
        'name_en',
        'address',
        'address_en',
        'purpose',
        'province_id',
        'district_id',
        'local_body_id',
        'ward_no',
        'way',
        'tole',
        'business_nature_id',
        'object_transaction_id',
        'working_capital',
        'fixed_capital',
        'investment',
        'is_rent',
        'house_owner_name',
        'house_owner_phone',
        'house_owner_address',
        'house_owner_monthly_rent',
        'length',
        'width',
        'application_date',
        'application_date_en',
        'rent_agreement',
        'land_ownership_certificate',
        'ward_recommendation',
        'embassy_document',
        'registration_document',
        'license',
        'tax_document',
        'bill_no',
        'bill_date_bs',
        'bill_date_ad',
        'taxpayer_number',
        'amount',
        'other_file',
        'mobile_user_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'is_register',
        'registration_month'
    ];

    public function getIsRegisterAttribute(): bool
    {
        return $this->registeredBusinesses->count() > 0;
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

    public function businessNature(): BelongsTo
    {
        return $this->belongsTo(BusinessNature::class);
    }


    public function objectTransaction(): BelongsTo
    {
        return $this->belongsTo(ObjectTransaction::class);
    }

    public function SourceOfCapital(): Attribute
    {
        return Attribute::get(fn ($value) => SourceOfCapital::tryFrom($value)?->label() ?? null);
    }

    public function BusinessType(): Attribute
    {
        return Attribute::get(fn ($value) => BusinessTypeEnum::tryFrom($value)?->label() ?? null);
    }


    public function investmentRevenue(): BelongsTo
    {
        return $this->belongsTo(InvestmentRevenue::class);
    }

    public function registeredBusinesses(): HasMany
    {
        return $this->hasMany(RegisteredBusiness::class);
    }

    public function partners(): HasMany
    {
        return $this->hasMany(Partner::class)->orderBy('position');
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'model');
    }

    public function businessRenew(): HasMany
    {
        return $this->hasMany(BusinessRenew::class);
    }


    public function setRentAgreementAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['rent_agreement'] = $value->store('business_registration/' . Str::slug($this->attributes['name_en']), 'public');
        }
    }

    public function getRentAgreementAttribute(): string
    {
        return $this->attributes['rent_agreement'] ? Storage::disk('public')->url($this->attributes['rent_agreement']) : '';
    }

    public function setLandOwnershipCertificateAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['land_ownership_certificate'] = $value->store('business_registration/' . Str::slug($this->attributes['name_en']), 'public');
        }
    }

    public function getLandOwnershipCertificateAttribute(): string
    {
        return $this->attributes['land_ownership_certificate'] ? Storage::disk('public')->url($this->attributes['land_ownership_certificate']) : '';
    }


    public function setWardRecommendationAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['ward_recommendation'] = $value->store('business_registration/' . Str::slug($this->attributes['name_en']), 'public');
        }
    }

    public function getWardRecommendationAttribute(): string
    {
        return $this->attributes['ward_recommendation'] ? Storage::disk('public')->url($this->attributes['ward_recommendation']) : '';
    }

    public function setEmbassyDocumentAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['embassy_document'] = $value->store('business_registration/' . Str::slug($this->attributes['name_en']), 'public');
        }
    }

    public function getEmbassyDocumentAttribute(): string
    {
        return $this->attributes['embassy_document'] ? Storage::disk('public')->url($this->attributes['embassy_document']) : '';
    }


    public function setRegistrationDocumentAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['registration_document'] = $value->store('business_registration/' . Str::slug($this->attributes['name_en']), 'public');
        }
    }

    public function getRegistrationDocumentAttribute(): string
    {
        return $this->attributes['registration_document'] ? Storage::disk('public')->url($this->attributes['registration_document']) : '';
    }


    public function setLicenseAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['license'] = $value->store('business_registration/' . Str::slug($this->attributes['name_en']), 'public');
        }
    }

    public function getLicenseAttribute(): string
    {
        return $this->attributes['license'] ? Storage::disk('public')->url($this->attributes['license']) : '';
    }


    public function setTaxDocumentAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['tax_document'] = $value->store('business_registration/' . Str::slug($this->attributes['name_en']), 'public');
        }
    }

    public function getTaxDocumentAttribute(): string
    {
        return $this->attributes['tax_document'] ? Storage::disk('public')->url($this->attributes['tax_document']) : '';
    }


    public function otherFile(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => !empty($value) ? Storage::url($value) : null,
            set: fn ($value) => (!empty($value) && !is_string($value))
                ? $value->store('other_file', 'public')
                : null
        );
    }

    public function getAreaAttribute(): float|int
    {
        return $this->attributes['length'] * $this->attributes['width'];
    }

    public function getRegistrationMonthAttribute(): string
    {
        return explode('-', $this->registration_date_ne)[1] ?? '';
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function mobileUser(): BelongsTo
    {
        return $this->belongsTo(MobileUser::class);
    }
}

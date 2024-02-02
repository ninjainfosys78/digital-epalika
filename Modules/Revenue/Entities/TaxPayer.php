<?php

namespace Modules\Revenue\Entities;

use App\Enums\Gender;
use App\Models\Address\District;
use App\Models\Address\LocalBody;
use App\Models\Address\Province;
use App\Models\MobileUser;
use App\Models\Settings\FiscalYear;
use App\Models\User;
use App\Traits\GetAllColumns;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class TaxPayer extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;
    use GetAllColumns;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'tax_payer_type_id',
        'fiscal_year_id',
        'user_id',
        'registration_no',
        'name',
        'name_en',
        'phone',
        'email',
        'address',
        'gender',
        'father_name',
        'grandfather_name',
        'citizenship_no',
        'issued_district',
        'issued_date',
        'ward',
        'tole',
        'remarks',
        'is_active',
        'occupation',
        'province_id',
        'district_id',
        'local_body_id',
        'village',
        'house_no',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function taxPayerType(): BelongsTo
    {
        return $this->belongsTo(TaxPayerType::class, 'tax_payer_type_id');
    }

    public function gender(): Attribute
    {
        return Attribute::set(function ($value) {
            return Gender::tryFrom($value) ?? '';
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeNotActive($query)
    {
        return $query->where('is_active', false);
    }

    public function taxPayerFamilies(): HasMany
    {
        return $this->hasMany(TaxPayerFamily::class);
    }

    public function taxPayerLands(): HasMany
    {
        return $this->hasMany(TaxPayerLand::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }


    public function mobileUsers():HasMany
    {
        return $this->hasMany(MobileUser::class);
    }
}

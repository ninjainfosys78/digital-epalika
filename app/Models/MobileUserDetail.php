<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class MobileUserDetail extends Model
{
    use HasFactory,SoftDeletes,EventObserveTrait;

    protected $dates=[
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable=[
        'mobile_user_id',
        'province_id',
        'district_id',
        'local_body_id',
        'ward_no',
        'tole',
        'temporary_province_id',
        'temporary_district_id',
        'temporary_local_body_id',
        'temporary_ward',
        'temporary_tole',
        'citizenship_no',
        'citizenship_issued_district',
        'citizenship_issued_date',
        'citizenship_front',
        'citizenship_back',
        'nec_no',
        'nec_certificate',
    ];

    public function mobileUser(): BelongsTo
    {
        return $this->belongsTo(MobileUser::class);
    }
    public function citizenshipFront(): Attribute
    {
        return Attribute::make(
            get: function (?string $value) {
                if (!empty($value) && Storage::disk('public')->exists($value)) {
                    return Storage::disk('public')->url($value);
                }

            },
            set: function ($value) {
                if (!empty($value) && !is_string($value)) {
                    return $value->store('mobileUserDetail/certificateFront', 'public');
                }
            }
        );
    }
    public function citizenshipBack(): Attribute
    {
        return Attribute::make(
            get: function (?string $value) {
                if (!empty($value) && Storage::disk('public')->exists($value)) {
                    return Storage::disk('public')->url($value);
                }

            },
            set: function ($value) {
                if (!empty($value) && !is_string($value)) {
                    return $value->store('mobileUserDetail/certificateBack', 'public');
                }
            }
        );
    }
    public function necCertificate(): Attribute
    {
        return Attribute::make(
            get: function (?string $value) {
                if (!empty($value) && Storage::disk('public')->exists($value)) {
                    return Storage::disk('public')->url($value);
                }

            },
            set: function ($value) {
                if (!empty($value) && !is_string($value)) {
                    return $value->store('mobileUserDetail/necCertificate', 'public');
                }
            }
        );
    }
}

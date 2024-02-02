<?php

namespace Modules\BusinessRegistration\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class BusinessRegistrationFile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'proprietor_detail_id',
        'photo',
        'citizenship_front',
        'citizenship_back',
        'company_registration',
        'tax_pay_file',
        'property',
        'signature',
        'thumb',
    ];

    public function setPhotoAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['photo'] = $value->store('business_registered/', 'public');
        }
    }

    public function getPhotoUrlAttribute()
    {
        return $this->attributes['photo'] ? Storage::disk('public')->url($this->attributes['photo']) : '';
    }

    public function setCitizenshipFrontAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['citizenship_front'] = $value->store('business_registered/', 'public');
        }
    }

    public function getCitizenshipFrontUrlAttribute()
    {
        return $this->attributes['citizenship_front'] ? Storage::disk('public')->url($this->attributes['citizenship_front']) : '';
    }

    public function setCitizenshipBackAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['citizenship_back'] = $value->store('business_registered/', 'public');
        }
    }

    public function getCitizenshipBackUrlAttribute()
    {
        return $this->attributes['citizenship_back'] ? Storage::disk('public')->url($this->attributes['citizenship_back']) : '';
    }

    public function setCompanyRegistrationAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['company_registration'] = $value->store('business_registered/', 'public');
        }
    }

    public function getCompanyRegistrationUrlAttribute()
    {
        return $this->attributes['company_registration'] ? Storage::disk('public')->url($this->attributes['company_registration']) : '';
    }

    public function setTaxPayFileAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['tax_pay_file'] = $value->store('business_registered/', 'public');
        }
    }

    public function getTaxPayFileUrlAttribute()
    {
        return $this->attributes['tax_pay_file'] ? Storage::disk('public')->url($this->attributes['tax_pay_file']) : '';
    }

    public function setPropertyAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['property'] = $value->store('business_registered/', 'public');
        }
    }

    public function getPropertyUrlAttribute()
    {
        return $this->attributes['property'] ? Storage::disk('public')->url($this->attributes['property']) : '';
    }

    public function setSignatureAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['signature'] = $value->store('business_registered/', 'public');
        }
    }

    public function getSignatureUrlAttribute()
    {
        return $this->attributes['signature'] ? Storage::disk('public')->url($this->attributes['signature']) : '';
    }

    public function setThumbAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['thumb'] = $value->store('business_registered/', 'public');
        }
    }

    public function getThumbUrlAttribute()
    {
        return $this->attributes['thumb'] ? Storage::disk('public')->url($this->attributes['thumb']) : '';
    }
}

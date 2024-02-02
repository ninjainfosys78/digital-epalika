<?php

namespace Modules\Recommendation\Entities;

use App\Enums\Gender;
use App\Models\Address\District;
use App\Models\Address\Province;
use App\Models\Address\LocalBody;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class PersonalDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'user_id',
        'reg_no',
        'name',
        'phone_no',
        'is_minor',
        'citizenship_no',
        'gender',
        'province_id',
        'district_id',
        'local_body_id',
        'ward_no',
        'tole'
    ];

    protected $casts = [
        'gender' => Gender::class
    ];

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
        return $this->belongsTo(localBody::class);
    }

    public function registrationDetails(): HasMany
    {
        return $this->hasMany(RegistrationDetail::class);
    }

    public function scopeFilterData($query)
    {
        if (auth()->user()->role->type !== 'Super') {
            $query->where('user_id', auth()->id());
        }
        return $query;
    }
}

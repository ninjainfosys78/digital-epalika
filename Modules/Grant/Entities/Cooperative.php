<?php

namespace Modules\Grant\Entities;

use App\Models\Address\District;
use App\Models\Address\LocalBody;
use App\Models\Address\Province;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use App\Traits\GetAllColumns;

class Cooperative extends Model
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
        'unique_id',
        'name',
        'cooperative_type_id',
        'registration_no',
        'registration_date',
        'vat_pan',
        'objective',
        'affiliation_id',
        'province_id',
        'district_id',
        'local_body_id',
        'ward_no',
        'village',
        'tole',
        'user_id',
    ];

    public function cooperativeType(): BelongsTo
    {
        return $this->belongsTo(CooperativeType::class);
    }

    public function affiliation(): BelongsTo
    {
        return $this->belongsTo(Affiliation::class);
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //    public function cooperativePersons(): HasMany
    //    {
    //        return $this->hasMany(CooperativePerson::class);
    //    }

    public function farmers(): BelongsToMany
    {
        return $this->belongsToMany(Farmer::class);
    }

    public function grantDetails(): MorphMany
    {
        return $this->morphMany(GrantDetail::class, 'model');
    }
}

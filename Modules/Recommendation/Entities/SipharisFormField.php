<?php

namespace Modules\Recommendation\Entities;

use App\Enums\FormFieldEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SipharisFormField extends Model
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
        'sipharish_form_type_id',
        'field_name',
        'slug',
        'created_by',
        'type',
        'sipharis_form_field_id',
    ];

    protected $casts = [
        'type' => FormFieldEnum::class
    ];

    public function SipharishFormField(): BelongsTo
    {
        return $this->belongsTo(SipharisFormField::class);
    }

    public function SipharishFormFields(): HasMany
    {
        return $this->hasMany(SipharisFormField::class);
    }


    public function SipharishFormType(): BelongsTo
    {
        return $this->belongsTo(SipharishFormType::class);
    }


    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

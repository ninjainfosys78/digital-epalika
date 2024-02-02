<?php

namespace Modules\Recommendation\Entities;

use App\Models\MobileUser;
use App\Models\User;
use App\Traits\NepaliDateConverter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class SipharishCreate extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;
    use NepaliDateConverter;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'sipharis_form_type_id',
        'personal_detail_id',
        'sipharis_signature_id',
        'signatured_by',
        'approved_by',
        'approved_date',
        'approved_status',
        'created_by',
        'status',
        'file',
        'mobile_user_id'
    ];
    protected $casts = [
        'status' => 'boolean',
    ];


    public function mobileUser(): BelongsTo
    {
        return $this->belongsTo(MobileUser::class);
    }

    public function signaturedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'signatured_by');
    }


    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function SipharishCreatedValues(): HasMany
    {
        return $this->hasMany(SipharishCreatedValue::class);
    }

    public function personalDetail(): BelongsTo
    {
        return $this->belongsTo(PersonalDetail::class);
    }

    public function SipharishFormType(): BelongsTo
    {
        return $this->belongsTo(SipharishFormType::class, 'sipharis_form_type_id');
    }

    public function SipharisCreatedDocuments(): HasMany
    {
        return $this->hasMany(SipharisCreatedDocument::class);
    }

    public function resolveTemplate(): string
    {
        $content = letterHead() . $this->SipharishFormType?->content;
        $replaceableList = collect();
        $this->load('SipharishFormType', 'SipharishCreatedValues.SipharisFormField');
        foreach ($this->SipharishCreatedValues?->load('SipharisFormField.SipharishFormFields') as $values) {
            if ($values->type == 'table') {
                $value = (string)View::make('recommendation::admin.sipharisCreate.recommendationTable', compact('values'));
            } else {
                $value = $values->value_data;
            }
            $replaceableList->put('{{' . $values->SipharisFormField?->field_name . '}}', $value);
            $replaceableList->put('[@form.' . $values->SipharisFormField?->field_name . ']', $value);
            if (!empty($values->SipharisFormField?->slug)) {
                $replaceableList->put('[@form.' . $values->SipharisFormField?->slug . ']', $value);
            }
        }
        $replaceableList->put('[@province]', officeSetting()->province?->province);
        $replaceableList->put('[@district]', officeSetting()->district?->district);
        $replaceableList->put('[@muncipal]', officeSetting()->localBody?->local_body);
        $replaceableList->put('[@ward_no]', auth()->user()->ward_no);
        $replaceableList->put('[@today_date_bs]', get_nepali_number($this->get_today_nepali_date()));
        $replaceableList->put('[@today_date_ad]', today()->toDateString());

        return Str::replace($replaceableList->keys(), $replaceableList->values(), $content ?? '');
    }

    public function signature()
    {
        return $this->belongsTo(SipharisSignatureDetail::class, 'sipharis_signature_id');
    }

    public function setFileAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['file'] = $value->store('sipharish/', 'public');
        }
    }

    public function getFileUrlAttribute(): string
    {
        return $this->attributes['file'] ? Storage::disk('public')->url($this->attributes['file']) : asset('images/user_icon.jpg');
    }
}

<?php

namespace Modules\Recommendation\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SipharishFormType extends Model
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
        'sipharis_sub_category_id',
        'title',
        'content',
        'need_approval',
        'status',
        'created_by'
    ];
    protected $casts = [
        'status' => 'boolean',
    ];


    public function sipharisFormFields(): HasMany
    {
        return $this->hasMany(SipharisFormField::class, 'sipharish_form_type_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function sipharisSubCategory(): BelongsTo
    {
        return $this->belongsTo(SipharisSubCategory::class);
    }

    public function sipharishCreates(): HasMany
    {
        return $this->hasMany(SipharishCreate::class);
    }


    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function getTemplateOptions(): array
    {
        return [[
            'title' => 'ठेगाना',
            'data' => [
                'प्रदेश' => '[@province]',
                'जिल्ला' => '[@district]',
                'पालिका' => '[@muncipal]',
                'वडा नं' => '[@ward_no]',
                'आजको मिति (बि‍.स‌.)' => '[@today_date_bs]',
                'आजको मिति (ई.स.)' => '[@today_date_ad]',
//                'लेटरहेड' => '[@letterHead]',
            ],
        ]];
    }
}

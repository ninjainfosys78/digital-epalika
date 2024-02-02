<?php

namespace App\Models;

use App\Enums\FeatureTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeatureActivation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'feature_name_ne',
        'feature_name_en',
        'feature_status',
        'feature_type',
        'feature_description',
    ];

    protected $casts = [
        'feature_type' => FeatureTypeEnum::class,
        'feature_status' => 'boolean',
    ];
}

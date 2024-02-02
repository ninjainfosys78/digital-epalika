<?php

namespace Modules\EMap\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\EMap\Enums\PostsEnum;

class DesignerDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'map_apply_id',
        'name',
        'father_name',
        'grandfather_name',
        'phone',
        'address',
        'local_body',
        'ward_no',
        'post',
        'nec_council_no',
        'local_body_registration_no',
        'consulting_firm_name',
    ];

    protected $casts = [
        'post' => PostsEnum::class,
    ];

    public function mapApply(): BelongsTo
    {
        return $this->belongsTo(MapApply::class);
    }
}

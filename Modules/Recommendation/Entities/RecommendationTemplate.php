<?php

namespace Modules\Recommendation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class RecommendationTemplate extends Model
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
        'recommendation_category_id',
        'is_active',
        'data',
        'title'
    ];


    public function scopeActive($q)
    {
        return $q->where('is_active', 1);
    }

    public function scopeNotActive($q)
    {
        return $q->where('is_active', 0);
    }

    private array $template = [
        [
            'title' => 'विवरण',
            'data' => [
                'कार्यालय नाम' => '[@office_name]',
                'कार्यालय लेटर हेड' => '[@letter_head]',
                'कार्यालय लेटर हेड (अंग्रेजीमा)' => '[@letter_head_en]',
                'आजको मिति' => '[@today_date]',
            ],
        ],[
            'title' => 'ठेगाना',
            'data' => [
                'प्रदेश' => '[@province]',
                'जिल्ला' => '[@district]',
                'पालिका' => '[@municipal]',
                'वडा नं' => '[@ward]',
                'अध्यक्ष' => '[@chairman]',
                'सचिव' => '[@secretary]',
            ],
        ],
    ];

    public function getTemplateOptions(): array
    {
        return $this->template;
    }
}

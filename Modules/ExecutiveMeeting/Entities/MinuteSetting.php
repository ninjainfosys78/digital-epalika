<?php

namespace Modules\ExecutiveMeeting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class MinuteSetting extends Model
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
        'description'
    ];


    private array $template = [
        [
            'title' => 'विवरण',
            'data' => [
                'बैठकको नाम'=>'[@metting_name]',
                'समिति नाम'=>'[@committee_name]',
                'कार्यालय नाम' => '[@office_name]',
                'कार्यालय लेटर हेड' => '[@letter_head]',
                'कार्यालय लेटर हेड (अंग्रेजीमा)' => '[@letter_head_en]',
                'आजको मिति' => '[@today_date]',
                'उपस्थित सदस्यहरु' => '[@present_member]',
                'आमंत्रित सदस्यहरु' => '[@invited_member]',
                'अध्यक्ष' => '[@chairman]',
                'निर्णय ' => '[@decision]',
            ],
        ]
    ];


    public function getTemplateOptions(): array
    {
        return $this->template;
    }
}

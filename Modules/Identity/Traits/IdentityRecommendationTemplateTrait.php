<?php

namespace Modules\Identity\Traits;

use App\Traits\NepaliDateConverter;
use Illuminate\Support\Str;
use Modules\Identity\Entities\RecommendationTemplateSetting;

trait IdentityRecommendationTemplateTrait
{
    use NepaliDateConverter;

    private array $template = [
        [
            'title' => 'अपाङ्गता विवरण',
            'data' => [
                'नाम' => '[@name]',
                'नाम (अंग्रेजीमा)' => '[@name_en]',
                'नागरिकता नं / जन्म दर्ता नं' => '[@document_no]',
                'जन्म मिति' => '[@dob]',
                'लिङ्ग' => '[@gender]',
                'अस्पतालको नाम' => '[@hospital]',
                'अस्पतालको ठेगाना' => '[@hospital_address]',
                'अपांगताको प्रकार' => '[@disabilityType]',
                'जिल्ला' => '[@district]',
                'पालिका' => '[@municipal]',
                'वडा नं' => '[@ward_no]',
                'टोल' => '[@tole]',
                'आजको मिति' => '[@today_date]',
                'कार्यालय लेटर हेड' => '[@letterHead]',
                'कार्यालय लेटर हेड (अंग्रेजीमा)' => '[@letterHeadEn]',
                'बाबुको नाम' => '[@father_name]',
                'बाबुको नाम (अंग्रेजीमा)' => '[@father_name_en]',
                'आमाको नाम' => '[@mother_name]',
                'आमाको नाम (अंग्रेजीमा)' => '[@mother_name_en]',
            ],
        ], [
            'title' => 'संरक्षकको विवरण',
            'data' => [
                'संरक्षकको नाम' => '[@guardian_name]',
                'संरक्षकको नाम (अंग्रेजीमा)' => '[@guardian_name_en]',
                'नाता' => '[@relationship]',
                'फोन' => '[@phone]',
            ],
        ],
    ];



    public function getIdentityTemplateData(RecommendationTemplateSetting $recommendationTemplateSetting): string
    {
        return $this->getData($recommendationTemplateSetting->description);
    }

    public function getTemplateOptions(): array
    {
        return $this->template;
    }

    private function getData($data): string
    {
        $replace = [];

        $replace = array_merge(
            $this->getDisabilityData(),
            $this->getGuardianData(),
            $replace
        );
        return Str::replace(array_keys($replace), $replace, $data);
    }


    public function getDisabilityData(): array
    {
        if(!empty($this->birth_registration_no)) {
            $documentNo = "$this->birth_registration_no (जन्म दर्ता)";
        } else {
            $documentNo = "$this->citizenship_no (नागरिकता)";
        }
        return [
            '[@name]' => $this->name ?? '',
            '[@letterHead]' => letterHead() ?? '',
            '[@letterHeadEn]' => letterHeadEn() ?? '',
            '[@hospital]' => $this->hospital->name ?? '',
            '[@hospital_address]' => $this->hospital->address ?? '',
            '[@name_en]' => $this->name_en ?? '',
            '[@document_no]' => get_nepali_number($documentNo) ?? '',
            '[@dob]' => get_nepali_number($this->dob) ?? '',
            '[@gender]' => $this->gender?->label() ?? '',
            '[@disabilityType]' => $this->disabilityType->title ?? '',
            '[@district]' => $this->district->district ?? '',
            '[@municipal]' => $this->localBody->local_body ?? '',
            '[@ward_no]' => get_nepali_number($this->ward_no) ?? '',
            '[@tole]' => $this->tole ?? '',
            '[@father_name]' => $this->father_name ?? '',
            '[@father_name_en]' => $this->father_name_en ?? '',
            '[@mother_name]' => $this->mother_name ?? '',
            '[@mother_name_en]' => $this->mother_name_en ?? '',
        ];
    }

    public function getGuardianData(): array
    {
        return [
            '[@guardian_name]' => $this->guardian_name ?? '',
            '[@guardian_name_en]' => $this->guardian_name_en ?? '',
            '[@relationship]' => $this->relationship->title ?? '',
            '[@phone]' => $this->phone ?? '',
        ];
    }
}

<?php

namespace Modules\BusinessRegistration\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Modules\BusinessRegistration\Entities\BusinessRegistrationTemplate;
use Modules\BusinessRegistration\Enums\TemplateTypeEnum;

trait BusinessDetailTemplateTrait
{
    private array $template = [
        [
            'title' => 'प्रोपराइटर',
            'data' => [
                'नाम' => '[@name]',
                'नागरिकता नम्बर' => '[@citizenship_no]',
                'जारी मिति' => '[@issue_date]',
                'जारी जिल्ला' => '[@issueDistrict.district]',
                'फोन नं' => '[@phone]',
                'इमेल' => '[@email]',
                'प्रदेश' => '[@province.province]',
                'जिल्ला' => '[@district.district]',
                'पालिका' => '[@localBody.local_body]',
                'वार्ड' => '[@ward_no]',
                'मार्ग' => '[@way]',
                'गाउ/टोल' => '[@tole]',
                'घर नम्बर' => '[@house_no]',
                'व्यक्तिगत स्थाई लेखा नम्बर' => '[@account_no]',
                'राष्ट्रियता परिचयपत्र नम्बर' => '[@national_card_no]',
                'लिङ्ग' => '[@gender]',
                'शैक्षिक योग्यता ' => '[@education_qualification]',
                'मुख्य पेशा ' => '[@occupation]',
            ],
        ],
        [
            'title' => 'व्यवसाय विवरण',
            'data' => [
                'फर्म/कम्पनी/ब्यवसाय को नाम नेपलीमा' => '[@businessDetail.business_detail_name]',
                'फर्म/कम्पनी/ब्यवसाय को नाम अंग्रेजीमा' => '[@businessDetail.business_detail_name_en]',
                'व्यवसायको प्रकृति' => '[@businessDetail.business_nature]',
                'व्यवसाय स्थापना गरेको साल' => '[@businessDetail.establish_year]',
                'व्यवसाय दर्ता मिति' => '[@businessDetail.registration_date]',
                'पान नम्बर' => '[@businessDetail.pan_no]',
                'लागत रकम रु' => '[@businessDetail.amount_cost]',
                'पूजीको स्रोत' => '[@businessDetail.source_of_capital]',
                'उदेश्य' => '[@businessDetail.purpose]',
                'रोजगार संख्या' => '[@businessDetail.employment]',
                'घर धनिको नाम थर' => '[@businessDetail.house_owner_name]',
                'घर धनिको मोबाइल न' => '[@businessDetail.house_owner_phone]',
                'ठेगाना' => '[@businessDetail.house_owner_address]',
                'मासिक भाडा रु' => '[@businessDetail.house_owner_monthly_rent]',
                'प्रदेश' => '[@businessDetail.province.province]',
                'जिल्ला' => '[@businessDetail.district.district]',
                'पालिका' => '[@businessDetail.localBody.local_body]',
                'वार्ड' => '[@businessDetail.ward_no]',
                'मार्ग' => '[@businessDetail.way]',
                'गाउ/टोल' => '[@businessDetail.tole]',
                'सबमिशन नम्बर' => '[@businessDetail.submission_no]',
                'आर्थिक बर्ष' => '[@businessDetail.fiscalYear.year]',
                'दर्ता नं' => '[@businessDetail.registration_no]',
                'दर्ता मिति नेपलीमा' => '[@businessDetail.registration_date_ne]',
                'दर्ता मिति अंग्रेजी' => '[@businessDetail.registration_date_en]',
            ],
        ],
        [
            'title' => 'परिचय पार्टी',
            'data' => [
                'लम्बाई' => '[@introBoard.length]',
                'चौडाई' => '[@introBoard.width]',
                'वर्गफिट' => '[@introBoard.square]',
            ],
        ],
        [
            'title' => 'पुँजीगत लगानी',
            'data' => [
                'शिर्षक' => '[@businessDetail.investment_revenue.title]',
                'दर्ता शुल्क' => '[@businessDetail.investment_revenue.registration_amount]',
                'नवीकरण शुल्क' => '[@businessDetail.investment_revenue.renew_amount]',
            ],
        ],
        [
            'title' => 'व्यवसायको किसिम',
            'data' => [
                'व्यवसायको वर्ग' => '[@businessDetail.investmentRevenue.objectTransaction.objectTransaction.title]',
                'व्यवसायको उप-वर्ग ' => '[@businessDetail.investmentRevenue.objectTransaction.title]',
            ],
        ],
        [
            'title' => 'दस्तुर',
            'data' => [
                'निवेदन दस्तुर' => '[@businessDetail.application_fee]',
                'दर्ता दस्तुर' => '[@businessDetail.registration_fee]',
                'व्यवसाय कर' => '[@businessDetail.business_tax]',
                'परिचय पाटी दस्तुर ' => '[@businessDetail.introduction_board_fees]',
                'जरिवाना' => '[@businessDetail.fine]',
                'दर्ता नम्बर' => '[@businessDetail.registration_no]',
                'मिति' => '[@businessDetail.date]',
                'जम्मा' => '[@businessDetail.total]',
            ],
        ],

    ];


    public function getSpecificTemplateData(TemplateTypeEnum $type): string
    {
        $templates = $this->getTemplateCache();

        $businessTemplate = $templates->where('status', 1)
            ->where('for', $type)
            ->first();

        if ($businessTemplate) {
            return $this->getData($businessTemplate->data);
        }

        return '';
    }

    public function getTemplateOptions(): array
    {
        return $this->template;
    }

    private function getData($data): string
    {
        $replace = [];

        $replace = array_merge($this->getProprietorReplacement(), $replace, $this->getCustomsDetailReplacement(), $this->getInvestmentRevenueReplacement(), $this->getIntroBoardReplacement(), $this->getBusinessDetailReplacement(), $this->getBusinessCategoryReplacement());

        return Str::replace(array_keys($replace), $replace, $data);
    }


    private function getCustomsDetailReplacement(): array
    {
        return [
            '[@businessDetail.application_fee]' => $this->application_fee ?? '',
            '[@businessDetail.registration_fee]' => $this->registration_fee ?? '',
            '[@businessDetail.business_tax]' => $this->business_tax ?? '',
            '[@businessDetail.introduction_board_fees]' => $this->introduction_board_fees ?? '',
            '[@businessDetail.fine]' => $this->fine ?? '',
            '[@businessDetail.registration_no]' => $this->registration_no ?? '',
            '[@businessDetail.date]' => $this->date ?? '',
            '[@businessDetail.total]' => $this->total_amount ?? 0,
        ];
    }

    private function getBusinessDetailReplacement(): array
    {
        return [
            '[@businessDetail.business_detail_name]' => $this->business_detail_name ?? '',
            '[@businessDetail.business_detail_name_en]' => $this->business_detail_name_en ?? '',
            '[@businessDetail.business_nature]' => $this->business_nature ?? '',
            '[@businessDetail.establish_year]' => $this->establish_year ?? '',
            '[@businessDetail.registration_date]' => $this->registration_date ?? '',
            '[@businessDetail.pan_no]' => $this->pan_no ?? '',
            '[@businessDetail.amount_cost]' => $this->amount_cost ?? '',
            '[@businessDetail.source_of_capital]' => $this->source_of_capital ?? '',
            '[@businessDetail.purpose]' => $this->purpose ?? '',
            '[@businessDetail.employment]' => $this->employment ?? '',
            '[@businessDetail.house_owner_name]' => $this->house_owner_name ?? '',
            '[@businessDetail.house_owner_phone]' => $this->house_owner_phone ?? '',
            '[@businessDetail.house_owner_address]' => $this->house_owner_address ?? '',
            '[@businessDetail.house_owner_monthly_rent]' => $this->house_owner_monthly_rent ?? '',
            '[@businessDetail.province.province]' => $this->province->province ?? '',
            '[@businessDetail.district.district]' => $this->district->district ?? '',
            '[@businessDetail.localBody.local_body]' => $this->localBody->local_body ?? '',
            '[@businessDetail.ward_no]' => $this->ward_no ?? '',
            '[@businessDetail.way]' => $this->way ?? '',
            '[@businessDetail.tole]' => $this->tole ?? '',
            '[@businessDetail.submission_no]' => $this->submission_no ?? '',
            '[@businessDetail.fiscalYear.year]' => $this->fiscalYear->year ?? '',
            '[@businessDetail.registration_no]' => $this->registration_no ?? '',
            '[@businessDetail.registration_date_ne]' => $this->registration_date_ne ?? '',
            '[@businessDetail.registration_date_en]' => $this->registration_date_en ?? '',
        ];
    }

    private function getIntroBoardReplacement(): array
    {
        return [
            '[@introBoard.length]' => $this->length ?? '',
            '[@introBoard.width]' => $this->width ?? '',
            '[@introBoard.square]' => $this->square ?? '',
        ];
    }

    private function getInvestmentRevenueReplacement(): array
    {
        return [
            '[@businessDetail.investment_revenue.title]' => $this->investRevenue->title ?? '',
            '[@businessDetail.investment_revenue.registration_amount]' => $this->investRevenue->registration_amount ?? '',
            '[@businessDetail.investment_revenue.renew_amount]' => $this->investRevenue->renew_amount ?? '',
        ];
    }

    private function getProprietorReplacement(): array
    {
        return [
            '[@name]' => $this->proprietorDetail->attributes['name'] ?? '',
            '[@citizenship_no]' => $this->proprietorDetail->attributes['citizenship_no'] ?? '',
            '[@issue_date]' => $this->proprietorDetail->attributes['name'] ?? '',
            '[@phone]' => $this->proprietorDetail->attributes['phone'] ?? '',
            '[@email]' => $this->proprietorDetail->attributes['email'] ?? '',
            '[@ward_no]' => $this->proprietorDetail->attributes['ward_no'] ?? '',
            '[@way]' => $this->proprietorDetail->attributes['way'] ?? '',
            '[@tole]' => $this->proprietorDetail->attributes['tole'] ?? '',
            '[@house_no]' => $this->proprietorDetail->attributes['house_no'] ?? '',
            '[@account_no]' => $this->proprietorDetail->attributes['account_no'] ?? '',
            '[@national_card_no]' => $this->proprietorDetail->attributes['national_card_no'] ?? '',
            '[@gender]' => $this->proprietorDetail->attributes['gender'] ?? '',
            '[@education_qualification]' => $this->proprietorDetail->attributes['education_qualification'] ?? '',
            '[@occupation]' => $this->proprietorDetail->attributes['occupation'] ?? '',
            '[@issueDistrict.district]' => $this->proprietorDetail->issueDistrict->district ?? '',
            '[@province.province]' => $this->proprietorDetail->province->province ?? '',
            '[@district.district]' => $this->proprietorDetail->district->district ?? '',
            '[@localBody.local_body]' => $this->proprietorDetail->localBody->local_body ?? '',

        ];
    }

    private function getBusinessCategoryReplacement(): array
    {
        return [
            '[@businessDetail.investmentRevenue.objectTransaction.objectTransaction.title]' => $this->investmentRevenue->objectTransaction->objectTransaction->title ?? '',
            '[@businessDetail.investmentRevenue.objectTransaction.title]' => $this->investmentRevenue->objectTransaction->title ?? '',
        ];
    }

    /**
     * @return mixed
     */
    private function getTemplateCache(): mixed
    {
        return Cache::rememberForever('businessTemplates', function () {
            return BusinessRegistrationTemplate::all();
        });
    }
}

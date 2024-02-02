<?php

namespace Modules\EMap\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Modules\EMap\Entities\EMapTemplate;
use Modules\EMap\Enums\NoticeTypeEnum;
use Modules\EMap\Enums\PostsEnum;

trait EMapTemplateTrait
{
    private array $template = [
        [
        
            'title' => 'प्रस्तावित भवनको विवरण',
            'data' => [
                'कार्यालय लेटर हेड' => '[@letterHead]',
                'कार्यालय लेटर हेड (अंग्रेजीमा)' => '[@letterHeadEn]',
                'दर्ता नम्बर' => '[@registration_no]',
                'दर्ता मिति' => '[@registration_date]',
                'निर्माण कार्यको किसिम' => '[@construction_type]',
                'प्रयोजन' => '[@usage]',
                'वर्ग' => '[@building_category]',
                'स्ट्रकचर टाईप' => '[@structureType]',
                'हाल निर्माण गर्ने तल्ला संख्या' => '[@current_storey]',
                'भविष्यमा निर्माण गर्ने तल्ला संख्या' => '[@future_storey]',
                'प्लिन्थको क्षेत्रफल' => '[@area_of_plinth]',
                'कुल भवनको लम्बाई' => '[@length]',
                'कुल भवनको चौडाई' => '[@breadth]',
                'भवनको कुल उचाई जमिनको सतहबाट' => '[@height]',
                'तल्लाको क्षेत्रफल र उचाईको विवरण' => '[@storeyDetails]',
            ],
        ],
        [
            'title' => 'जग्गाको विवरण',
            'data' => [
                'भू-उपयोग्य क्षेत्र' => '[@landDetail.land_use_area.title]',
                'वडा नं.' => '[@landDetail.ward_no]',
                'साविक वडा नं.' => '[@landDetail.former_ward_no]',
                'टोलको नाम' => '[@landDetail.tole]',
                'सडक कोड नं.' => '[@landDetail.street_code_no]',
                'जग्गा कित्ता नं.' => '[@landDetail.plot_no]',
                'क्षेत्रफल' => '[@landDetail.area]',
                'भवनले ढाक्ने क्षेत्रफलको प्रतिशत (GCR)' => '[@landDetail.percentage_of_area_covered_by_building]',
            ],
        ],
        [
            'title' => 'जग्गा धनीको विवरण',
            'data' => [
                'जग्गा धनीको किसिम' => '[@landOwner.land_owner_type]',
                'नाम' => '[@landOwner.name]',
                'फोन नं.' => '[@landOwner.phone]',
                'बुवाको नाम' => '[@landOwner.father_name]',
                'हजुरबुबाको नाम' => '[@landOwner.grandfather_name]',
                'नागरिकता लिएको जिल्ला' => '[@landOwner.citizenship_issue_district]',
                'नागरिकत नम्बर' => '[@landOwner.citizenship_no]',
                'नागरिकता लिएको मिति' => '[@landOwner.citizenship_issue_date]',
                'ठेगाना' => '[@landOwner.address]',
                'पालिका' => '[@landOwner.local_body]',
                'वडा नं' => '[@landOwner.ward_no]',
            ],
        ],
        [
            'title' => 'घर धनीको विवरण',
            'data' => [
                'नाम' => '[@houseOwner.name]',
                'फोन नं.' => '[@houseOwner.phone]',
                'बुवाको नाम' => '[@houseOwner.father_name]',
                'हजुरबुबाको नाम' => '[@houseOwner.grandfather_name]',
                'नागरिकता लिएको जिल्ला' => '[@houseOwner.citizenship_issue_district]',
                'नागरिकत नम्बर' => '[@houseOwner.citizenship_no]',
                'नागरिकता लिएको मिति' => '[@houseOwner.citizenship_issue_date]',
                'ठेगाना' => '[@houseOwner.address]',
                'पालिका' => '[@houseOwner.local_body]',
                'वडा नं' => '[@houseOwner.ward_no]',
            ],
        ],
        [
            'title' => 'चार किल्लाको विवरण',
            'data' => [
                'किल्ला' => '[@fourForts]',
            ],
        ],
        [
            'title' => 'डिजाइनरको विवरण',
            'data' => [
                'नाम' => '[@designerDetail.name]',
                'फोन नं.' => '[@designerDetail.phone]',
                'बुवाको नाम' => '[@designerDetail.father_name]',
                'ठेगाना' => '[@designerDetail.address]',
                'पालिका' => '[@designerDetail.local_body]',
                'वडा नं.' => '[@designerDetail.ward_no]',
                'NEC Council No.' => '[@designerDetail.nec_council_no]',
                'पालिकाको दर्ता नं.' => '[@designerDetail.local_body_registration_no]',
                'कन्सल्टिंग फर्मबाट भए सो को नाम ' => '[@designerDetail.consulting_firm_name]',
            ],
        ],
        [
            'title' => 'सुपरभाइजर विवरण',
            'data' => [
                'नाम' => '[@supervisorDetail.name]',
                'फोन नं.' => '[@supervisorDetail.phone]',
                'बुवाको नाम' => '[@supervisorDetail.father_name]',
                'ठेगाना' => '[@supervisorDetail.address]',
                'पालिका' => '[@supervisorDetail.local_body]',
                'वडा नं.' => '[@supervisorDetail.ward_no]',
                'NEC Council No.' => '[@supervisorDetail.nec_council_no]',
                'पालिकाको दर्ता नं.' => '[@supervisorDetail.local_body_registration_no]',
                'कन्सल्टिंग फर्मबाट भए सो को नाम ' => '[@supervisorDetail.consulting_firm_name]',
            ],
        ],
        [
            'title' => 'ठेकेदारको विवरण',
            'data' => [
                'नाम' => '[@contractorDetail.name]',
                'फोन नं.' => '[@contractorDetail.phone]',
                'बुवाको नाम' => '[@contractorDetail.father_name]',
                'ठेगाना' => '[@contractorDetail.address]',
                'पालिका' => '[@contractorDetail.local_body]',
                'वडा नं.' => '[@contractorDetail.ward_no]',
                'NEC Council No.' => '[@contractorDetail.nec_council_no]',
                'पालिकाको दर्ता नं.' => '[@contractorDetail.local_body_registration_no]',
                'कन्सल्टिंग फर्मबाट भए सो को नाम ' => '[@contractorDetail.consulting_firm_name]',
            ],
        ],
        [
            'title' => 'निवेदकको विवरण',
            'data' => [
                'निवेदकको प्रकार' => '[@applicantDetail.applicant_type]',
                'घरधनी सँगको सम्बन्ध' => '[@applicantDetail.relation_with_owner]',
                'नाम' => '[@applicantDetail.name]',
                'फोन नं.' => '[@applicantDetail.phone]',
                'बुवाको नाम' => '[@applicantDetail.father_name]',
                'नागरिकता लिएको जिल्ला' => '[@applicantDetail.citizenship_issue_district]',
                'नागरिकत नम्बर' => '[@applicantDetail.citizenship_no]',
                'नागरिकता लिएको मिति' => '[@applicantDetail.citizenship_issue_date]',
                'निवेदकको सहि' => '[@applicantDetail.signature_url]',
            ],
        ],
        [
            'title' => 'निर्माण हुने भवन तथा मापदण्ड सम्बन्धि संक्षिप्त विवरण',
            'data' => [
                'मापदण्ड सम्बन्धि विवरण' => '[@criteriaDetails]',
            ],
        ],
        [
            'title' => 'भवन सम्बन्धि विवरण',
            'data' => [
                'भवन विवरण' => '[@buildingDetails]',
            ],
        ],
    ];

    public function getTemplateDataAttribute(): Collection
    {
        return $this->getEmapTemplates()->map(function ($applicationTemplate) {
            $data = $this->getData($applicationTemplate->data);

            return [
                'for' => $applicationTemplate->for,
                'data' => $data,
            ];
        });
    }

    public function getSpecificTemplateData(NoticeTypeEnum $noticeTypeEnum): string
    {
        $eMapTemplate = $this->getEmapTemplates();
        $mapTemplate = $eMapTemplate->where('for', $noticeTypeEnum)->where('status', 1)->first();

        if ($mapTemplate) {
            return $this->getData($mapTemplate->data);
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

        $replace = array_merge(
            $this->getLetterHeadReplacement(),
            $this->getMapApplyReplacement(),       
            $this->getLandDetailReplacement(),
            $this->getLandOwnerReplacement(),
            $this->getHouseOwnerReplacement(),
            $this->getFourFortsReplacement(),
            $this->getApplicantDetailReplacement(),
            $this->getCriteriaDetailsReplacement(),
            $this->getBuildingDetailsReplacement(),
            $this->getDesignerDetailsReplacement(),
            $this->getSupervisorDetailsReplacement(),
            $this->getContractorDetailsReplacement(),
            $replace
        );

        return Str::replace(array_keys($replace), $replace, $data);
    }

    private function getLetterHeadReplacement(): array
    {
        return [
          
        ];
    }

    private function getMapApplyReplacement(): array
    {
        return [
            '[@letterHead]' =>$this->letterHead() ?? '',
            '[@letterHeadEn]' =>$this->letterHeadEn() ?? '',
            '[@registration_no]' => $this->registration_no ?? '',
            '[@registration_date]' => $this->registration_date ?? '',
            '[@construction_type]' => $this->construction_type?->label() ?? '',
            '[@usage]' => $this->usage?->label() ?? '',
            '[@building_category]' => $this->building_category?->label() ?? '',
            '[@structureType]' => $this->structureType->title ?? '',
            '[@current_storey]' => $this->current_storey ?? '',
            '[@future_storey]' => $this->future_storey ?? '',
            '[@area_of_plinth]' => $this->area_of_plinth ?? '',
            '[@length]' => $this->length ?? '',
            '[@breadth]' => $this->breadth ?? '',
            '[@height]' => $this->height ?? '',
        ];
    }

    private function getLandDetailReplacement(): array
    {
        return [
            '[@landDetail.land_use_area.title]' => $this->landDetail?->landUseArea?->title ?? '',
            '[@landDetail.ward_no]' => $this->landDetail->ward_no ?? '',
            '[@landDetail.former_ward_no]' => $this->landDetail->former_ward_no ?? '',
            '[@landDetail.tole]' => $this->landDetail->tole ?? '',
            '[@landDetail.street_code_no]' => $this->landDetail->street_code_no ?? '',
            '[@landDetail.plot_no]' => $this->landDetail->plot_no ?? '',
            '[@landDetail.area]' => $this->landDetail->area ?? '',
            '[@landDetail.percentage_of_area_covered_by_building]' => $this->landDetail->percentage_of_area_covered_by_building ?? '',
        ];
    }

    private function getLandOwnerReplacement(): array
    {
        return [
            '[@landOwner.land_owner_type]' => $this->landOwner->land_owner_type->label() ?? '',
            '[@landOwner.name]' => $this->landOwner->name ?? '',
            '[@landOwner.phone]' => $this->landOwner->phone ?? '',
            '[@landOwner.father_name]' => $this->landOwner->father_name ?? '',
            '[@landOwner.grandfather_name]' => $this->landOwner->grandfather_name ?? '',
            '[@landOwner.citizenship_issue_district]' => $this->landOwner->citizenshipIssueDistrict->district ?? '',
            '[@landOwner.citizenship_no]' => $this->landOwner->citizenship_no ?? '',
            '[@landOwner.citizenship_issue_date]' => $this->landOwner->citizenship_issue_date ?? '',
            '[@landOwner.address]' => $this->landOwner->address ?? '',
            '[@landOwner.local_body]' => $this->landOwner->local_body ?? '',
            '[@landOwner.ward_no]' => $this->landOwner->ward_no ?? '',
        ];
    }

    private function getHouseOwnerReplacement(): array
    {
        return [
            '[@houseOwner.name]' => $this->houseOwner->name ?? '',
            '[@houseOwner.phone]' => $this->houseOwner->phone ?? '',
            '[@houseOwner.father_name]' => $this->houseOwner->father_name ?? '',
            '[@houseOwner.grandfather_name]' => $this->houseOwner->grandfather_name ?? '',
            '[@houseOwner.citizenship_issue_district]' => $this->houseOwner->citizenshipIssueDistrict->district ?? '',
            '[@houseOwner.citizenship_no]' => $this->houseOwner->citizenship_no ?? '',
            '[@houseOwner.citizenship_issue_date]' => $this->houseOwner->citizenship_issue_date ?? '',
            '[@houseOwner.address]' => $this->houseOwner->address ?? '',
            '[@houseOwner.local_body]' => $this->houseOwner->local_body ?? '',
            '[@houseOwner.ward_no]' => $this->houseOwner->ward_no ?? '',
        ];
    }

    private function getFourFortsReplacement(): array
    {
        return [
            '[@fourForts]' => (string)View::make('emap::inc.four_forts_table', [
                'fourForts' => $this->fourForts,
            ]),
        ];
    }

    private function getDesignerDetailsReplacement(): array
    {
        $designerDetail = $this->designerDetails->where('post', PostsEnum::DESIGNER)->first();

        return [
            '[@designerDetail.name]' => $designerDetail->name ?? '',
            '[@designerDetail.father_name]' => $designerDetail->father_name ?? '',
            '[@designerDetail.phone]' => $designerDetail->name ?? '',
            '[@designerDetail.address]' => $designerDetail->address ?? '',
            '[@designerDetail.local_body]' => $designerDetail->local_body ?? '',
            '[@designerDetail.ward_no]' => $designerDetail->ward_no ?? '',
            '[@designerDetail.nec_council_no]' => $designerDetail->nec_council_no ?? '',
            '[@designerDetail.local_body_registration_no]' => $designerDetail->local_body_registration_no ?? '',
            '[@designerDetail.consulting_firm_name]' => $designerDetail->consulting_firm_name ?? '',
        ];
    }

    private function getSupervisorDetailsReplacement(): array
    {
        $supervisorDetail = $this->designerDetails->where('post', PostsEnum::SUPERVISOR)->first();

        return [
            '[@supervisorDetail.name]' => $supervisorDetail->name ?? '',
            '[@supervisorDetail.father_name]' => $supervisorDetail->father_name ?? '',
            '[@supervisorDetail.phone]' => $supervisorDetail->name ?? '',
            '[@supervisorDetail.address]' => $supervisorDetail->address ?? '',
            '[@supervisorDetail.local_body]' => $supervisorDetail->local_body ?? '',
            '[@supervisorDetail.ward_no]' => $supervisorDetail->ward_no ?? '',
            '[@supervisorDetail.nec_council_no]' => $supervisorDetail->nec_council_no ?? '',
            '[@supervisorDetail.local_body_registration_no]' => $supervisorDetail->local_body_registration_no ?? '',
            '[@supervisorDetail.consulting_firm_name]' => $supervisorDetail->consulting_firm_name ?? '',
        ];
    }

    private function getContractorDetailsReplacement(): array
    {
        $contractorDetail = $this->designerDetails->where('post', PostsEnum::CONTRACTOR)->first();

        return [
            '[@contractorDetail.name]' => $contractorDetail->name ?? '',
            '[@contractorDetail.father_name]' => $contractorDetail->father_name ?? '',
            '[@contractorDetail.phone]' => $contractorDetail->name ?? '',
            '[@contractorDetail.address]' => $contractorDetail->address ?? '',
            '[@contractorDetail.local_body]' => $contractorDetail->local_body ?? '',
            '[@contractorDetail.ward_no]' => $contractorDetail->ward_no ?? '',
            '[@contractorDetail.nec_council_no]' => $contractorDetail->nec_council_no ?? '',
            '[@contractorDetail.local_body_registration_no]' => $contractorDetail->local_body_registration_no ?? '',
            '[@contractorDetail.consulting_firm_name]' => $contractorDetail->consulting_firm_name ?? '',
        ];
    }

    private function getApplicantDetailReplacement(): array
    {
        return [
            '[@applicantDetail.applicant_type]' => $this->applicantDetail->applicant_type->label() ?? '',
            '[@applicantDetail.relation_with_owner]' => $this->applicantDetail->relation_with_owner->label() ?? '',
            '[@applicantDetail.name]' => $this->applicantDetail->name ?? '',
            '[@applicantDetail.phone]' => $this->applicantDetail->phone ?? '',
            '[@applicantDetail.father_name]' => $this->applicantDetail->father_name ?? '',
            '[@applicantDetail.citizenship_issue_district]' => $this->applicantDetail->citizenshipIssueDistrict->district ?? '',
            '[@applicantDetail.citizenship_no]' => $this->applicantDetail->citizenship_no ?? '',
            '[@applicantDetail.citizenship_issue_date]' => $this->applicantDetail->citizenship_issue_date ?? '',
            '[@applicantDetail.signature_url]' => $this->applicantDetail->signature_url ?? '',
        ];
    }

    private function getCriteriaDetailsReplacement(): array
    {
        return [
            '[@criteriaDetails]' => (string)View::make('emap::inc.criteria_details', [
                'criteriaDetails' => $this->criteriaDetails,
            ]),
        ];
    }

    private function getBuildingDetailsReplacement(): array
    {
        return [
            '[@buildingDetails]' => (string)View::make('emap::inc.building_details', [
                'buildingDetails' => $this->buildingDetails,
            ]),
        ];
    }

    /**
     * @return mixed
     */
    public function getEmapTemplates(): mixed
    {
        return Cache::rememberForever('eMapTemplates', function () {
            return EMapTemplate::all();
        });
    }
}

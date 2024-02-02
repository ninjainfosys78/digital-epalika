<?php

namespace Modules\EMap\Enums;

use Exception;
use Illuminate\Support\Collection;

enum NoticeTypeEnum: string
{
    //for consultant
    case MAP_ACCEPTANCE = 'map_acceptance';
    case TECHNICIAN_APPROVAL = 'technician_approval';
    case ENGINEER_APPROVAL = 'engineer_approval';
    case BUILDING_DESIGN = 'building_design';
    case STRUCTURAL_DETAIL = 'structural_detail';
    case DESIGN_RELATED = 'design_related';
    case ELECTRICAL_DESIGN = 'electrical_design';
    case APPROVAL_LETTER_FROM_BUILDING_CONTRACTOR = 'approval_letter_from_building_contractor';
    case BUILDING_DESIGN_DETAILS = 'building_design_details';
    case BUILDING_COMPLIANCE_CHECKLIST = 'building_compliance_checklist';

    //municipal
    case REGARDING_FEES_AND_REGISTRATION = 'fees_registration';
    case NOTICE_ISSUED_IN_THE_NAME_OF_SANGHIAR = 'notice_issued_name_sanghiar';
    case FIFTEEN_DAYS_NOTICE_ADJOURNED = '15_days_notice_adjourned';
    case FIFTEEN_DAY_GRACE_PERIOD_FOR_MAP_PASS = '15_day_grace_period_map_pass';
    case SARZAMIN_MUCHULKA = 'sarzamin_muchulka';
    case TECHNICAL_REPORT = 'technical_report';
    //agreement enums
    case AGREEMENT_LETTER_BETWEEN_SUPERVISOR_CONSULTANT_AND_LANDLORD = 'agreement_letter_supervisor_landlord)';
    case AGREEMENT_LETTER_HOMEOWNER_AND_BUILDER_CONTRACTOR = 'agreement_letter_homeowner_contractor)';
    case GRANTING_PERMISSION_FOR_CONSTRUCTION_UP_TO_THE_PLINTH_LEVEL_OF_THE_HOUSE = 'granting_plinth_permit';
    case PERMISSION_LETTER_FOR_CONSTRUCTION_WORK_UP_TO_PLINTH_LEVEL = 'permission_letter_construction_work_plinth_level';
    case CONSTRUCTION_SUPERVISION_REPORT_UP_TO_PLINTH_LEVEL = 'construction_supervision_report_plinth_level';
    case CONSULTANTS_REPORT_ON_COMPLETION_OF_FIRST_PHASE = 'consultants_Report_on_Completion_First_Phase';
    case THE_TECHNICIAN_WHO_COMPLETED_THE_FIRST_PHASE_OF_WORK_REPORT = 'technician_completed_first_phase_work_report';
    case REGARDING_PERMISSION_FOR_CONSTRUCTION_WORK_OF_SUPERSTRUCTURE = 'permission_construction_work_superstructure';
    case REGARDING_SUPERSTRUCTURE_PERMIT = 'superstructure_permit';
    case PERMANENT_BUILDING_PERMIT_FOR_SUPERSTRUCTURE = 'Permanent_Building_Permit_Superstructure';
    case CONSTRUCTION_SUPERVISION_REPORT_UPTO_SUPERSTRUCTURE = 'construction_supervision_report_superstructure';
    case REVISED_SUPERSTRUCTURE_PERMIT_ORDER = 'revised_superstructure_permit_order';
    case REVISED_SUPERSTRUCTURE_PERMIT = 'revised_superstructure_permit';
    case CONSTRUCTION_COMPLETION_CERTIFICATE_APPLICATION = 'application_construction_completion_certificate';
    case CONSULTANTS_REPORT_ON_COMPLETION_OF_SECOND_PHASE = 'consultants_Report_on_Completion_Second_Phase';
    case THE_TECHNICIAN_WHO_COMPLETED_THE_SECOND_PHASE_OF_WORK_REPORT = 'technician_completed_second_phase_work_report';
    case REGARDING_CONSTRUCTION_COMPLETION_CERTIFICATE = 'construction_completion_certificate';
    case BUILDING_COMPLETION_CERTIFICATE = 'building_completion_certificate';
    case HOUSE_MAP_NAMSARI = 'house_map_namsari';
    case REGARDING_SENDING_DETAILS = 'sending_details';
    case HEIR = 'heir';
    case PERMISSION = 'permission';
    case MAP_PASS_FOR_BUILDING = 'map_pass_building';
    //certificate enums
    case MAP_CERTIFICATE = 'map_certificate';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            //application enums
            self::TECHNICIAN_APPROVAL => 'नक्सा बनाउने प्राविधिकद्वारा मन्जुरी पत्र',
            self::MAP_ACCEPTANCE => 'भवन निर्माण सहिता अनुसार नक्शा / डिजाईनको लागि दरखास्त फाराम',
            self::ENGINEER_APPROVAL => 'भवन डिजाईन गर्ने प्राविधिकद्वारा मन्जुरी पत्र',
            self::BUILDING_DESIGN => 'भवन डिजाईनको विवरण (आर्किटेक्चरल डिजाइन सम्बन्धी)',
            self::STRUCTURAL_DETAIL => 'स्ट्रक्चरल डिजाईन सम्बन्धी विवरण फारम',
            self::DESIGN_RELATED => 'स्यानिटरि डिजाईन सम्बन्धी',
            self::ELECTRICAL_DESIGN => 'इलेक्ट्रिकल डिजाईन सम्बन्धी',
            self::APPROVAL_LETTER_FROM_BUILDING_CONTRACTOR => 'भवन निर्माण गर्ने ठेकेदारद्वारा मन्जुरी पत्र',
            self::MAP_PASS_FOR_BUILDING => 'भवन निर्माणको लागि नक्सापास सम्बन्धमा',
            self::REGARDING_PERMISSION_FOR_CONSTRUCTION_WORK_OF_SUPERSTRUCTURE => 'सुपरस्ट्रक्चरको निर्माण कार्यको लागि इजाजत बारे',
            self::CONSTRUCTION_COMPLETION_CERTIFICATE_APPLICATION => 'निर्माण कार्य सम्पन्न प्रमाण पत्रको लागि निवेदन',
            self::REGARDING_CONSTRUCTION_COMPLETION_CERTIFICATE => 'निर्माण कार्य सम्पन्न प्रमाण-पत्र सम्बन्धमा',

            //notice enums
            self::NOTICE_ISSUED_IN_THE_NAME_OF_SANGHIAR => 'संघियारको नाममा जारी भएको सूचना',
            self::FIFTEEN_DAYS_NOTICE_ADJOURNED => '१५ दिने सूचना टाँस सम्बन्धमा',
            self::REGARDING_SENDING_DETAILS => 'विवरण पठाएको सम्बन्धमा',
            self::REVISED_SUPERSTRUCTURE_PERMIT => 'संशोधित सुपरस्ट्रक्चर इजाजत सम्बन्धमा',
            //bond enums
            self::FIFTEEN_DAY_GRACE_PERIOD_FOR_MAP_PASS => 'नक्सा पासको लागि १५ दिने टाँस मुचुल्का',
            self::SARZAMIN_MUCHULKA => 'सरजमिन मुचुल्का',
            //report enums
            self::BUILDING_DESIGN_DETAILS => 'भवन डिजाइन विवरण',
            self::BUILDING_COMPLIANCE_CHECKLIST => 'भवन अनुपालन चेकलिस्ट',
            self::TECHNICAL_REPORT => 'प्राविधिक प्रतिवेदन',
            self::CONSTRUCTION_SUPERVISION_REPORT_UP_TO_PLINTH_LEVEL => 'प्लिन्थ लेभलसम्मको निर्माणको सुपरिवेक्षण प्रतिवेदन',
            self::THE_TECHNICIAN_WHO_COMPLETED_THE_FIRST_PHASE_OF_WORK_REPORT => 'प्रथम चरणको कार्य सम्पन्नको प्राबिधिकको प्रतिबेदन',
            self::CONSULTANTS_REPORT_ON_COMPLETION_OF_FIRST_PHASE => 'प्रथम चरणको कार्य सम्पन्नको परामर्शदाताको प्रतिबेदन',
            self::THE_TECHNICIAN_WHO_COMPLETED_THE_SECOND_PHASE_OF_WORK_REPORT => 'दोस्रो चरणको कार्य सम्पन्नको प्राबिधिकको प्रतिबेदन',
            self::CONSULTANTS_REPORT_ON_COMPLETION_OF_SECOND_PHASE => 'दोस्रो चरणको कार्य सम्पन्नको परामर्शदाताको प्रतिबेदन',
            self::CONSTRUCTION_SUPERVISION_REPORT_UPTO_SUPERSTRUCTURE => 'सुपरस्ट्रक्चर सम्म निर्माणको सुपरिवेक्षण प्रतिवेदन',

            //agreement
            self::AGREEMENT_LETTER_BETWEEN_SUPERVISOR_CONSULTANT_AND_LANDLORD => 'सम्झौता पत्र (सुपरिवेक्षक/कन्सल्टेन्ट तथा घरधनी बीच)',
            self::AGREEMENT_LETTER_HOMEOWNER_AND_BUILDER_CONTRACTOR => 'सम्झौता पत्र (घरधनी र निर्माणकर्मी/ठेकेदार)',

            //order
            self::GRANTING_PERMISSION_FOR_CONSTRUCTION_UP_TO_THE_PLINTH_LEVEL_OF_THE_HOUSE => 'घरको प्लिन्थ लेभल सम्मको निर्माणका निमित्त इजाजत प्रदान गर्ने',
            self::REGARDING_SUPERSTRUCTURE_PERMIT => 'सुपरस्ट्रक्चर इजाजत सम्बन्धमा',
            self::REVISED_SUPERSTRUCTURE_PERMIT_ORDER => '(टिप्पणी र आदेश) संशोधित सुपरस्ट्रक्चर इजाजत सम्बन्धमा',
            self::HOUSE_MAP_NAMSARI => 'घरनक्सा नामसारी',
            //certificate enums
            self::PERMISSION_LETTER_FOR_CONSTRUCTION_WORK_UP_TO_PLINTH_LEVEL => 'प्लिन्थ लेभलसम्म निर्माण कार्यको ईजाजत पत्र',
            self::PERMANENT_BUILDING_PERMIT_FOR_SUPERSTRUCTURE => 'भवन निर्माण स्थायी ईजाजत पत्र (Superstructure को लागि)',
            self::BUILDING_COMPLETION_CERTIFICATE => 'भवन निर्माण कार्य सम्पन्न प्रमाण-पत्र',
            self::MAP_CERTIFICATE => 'नक्सा प्रमाणित प्रमाण-पत्र',

            //registration
            self::REGARDING_FEES_AND_REGISTRATION => 'दस्तुर तथा दर्ता सम्बन्धि',

            //heir
            self::HEIR => 'वारेसनामा',
            //permission enums
            self::PERMISSION => 'मन्जुरीनामा'
        };
    }

    public function showInMapVerification(): bool
    {
        return self::getShowInMapVerification($this);
    }

    public static function getShowInMapVerification(self $value): bool
    {
        return match ($value) {
            //heir
            self::HEIR, self::GRANTING_PERMISSION_FOR_CONSTRUCTION_UP_TO_THE_PLINTH_LEVEL_OF_THE_HOUSE, self::AGREEMENT_LETTER_HOMEOWNER_AND_BUILDER_CONTRACTOR, self::AGREEMENT_LETTER_BETWEEN_SUPERVISOR_CONSULTANT_AND_LANDLORD, self::TECHNICAL_REPORT, self::PERMISSION, self::MAP_ACCEPTANCE, self::TECHNICIAN_APPROVAL, self::BUILDING_DESIGN, self::ENGINEER_APPROVAL, self::STRUCTURAL_DETAIL, self::DESIGN_RELATED, self::ELECTRICAL_DESIGN, self::MAP_PASS_FOR_BUILDING, self::NOTICE_ISSUED_IN_THE_NAME_OF_SANGHIAR, self::FIFTEEN_DAYS_NOTICE_ADJOURNED, self::FIFTEEN_DAY_GRACE_PERIOD_FOR_MAP_PASS, self::SARZAMIN_MUCHULKA => true,

            self::APPROVAL_LETTER_FROM_BUILDING_CONTRACTOR, self::MAP_CERTIFICATE, self::REGARDING_FEES_AND_REGISTRATION, self::PERMANENT_BUILDING_PERMIT_FOR_SUPERSTRUCTURE, self::BUILDING_COMPLETION_CERTIFICATE, self::REGARDING_SUPERSTRUCTURE_PERMIT, self::REVISED_SUPERSTRUCTURE_PERMIT_ORDER, self::HOUSE_MAP_NAMSARI, self::PERMISSION_LETTER_FOR_CONSTRUCTION_WORK_UP_TO_PLINTH_LEVEL, self::CONSTRUCTION_SUPERVISION_REPORT_UPTO_SUPERSTRUCTURE, self::CONSULTANTS_REPORT_ON_COMPLETION_OF_SECOND_PHASE, self::THE_TECHNICIAN_WHO_COMPLETED_THE_SECOND_PHASE_OF_WORK_REPORT, self::CONSULTANTS_REPORT_ON_COMPLETION_OF_FIRST_PHASE, self::THE_TECHNICIAN_WHO_COMPLETED_THE_FIRST_PHASE_OF_WORK_REPORT, self::CONSTRUCTION_SUPERVISION_REPORT_UP_TO_PLINTH_LEVEL, self::BUILDING_COMPLIANCE_CHECKLIST, self::BUILDING_DESIGN_DETAILS, self::REGARDING_PERMISSION_FOR_CONSTRUCTION_WORK_OF_SUPERSTRUCTURE, self::CONSTRUCTION_COMPLETION_CERTIFICATE_APPLICATION, self::REGARDING_CONSTRUCTION_COMPLETION_CERTIFICATE, self::REGARDING_SENDING_DETAILS, self::REVISED_SUPERSTRUCTURE_PERMIT => false,

        };
    }

    /**
     * @throws Exception
     */
    public function fileType(): FileTypeEnum
    {
        return self::getFileType($this);
    }

    /**
     * @throws Exception
     */
    public static function getFileType(self $value): FileTypeEnum
    {
        return match ($value) {
            //application enums
            self::MAP_ACCEPTANCE,
            self::BUILDING_DESIGN,
            self::TECHNICIAN_APPROVAL,
            self::ENGINEER_APPROVAL,
            self::STRUCTURAL_DETAIL,
            self::DESIGN_RELATED,
            self::ELECTRICAL_DESIGN,
            self::MAP_PASS_FOR_BUILDING,
            self::REGARDING_PERMISSION_FOR_CONSTRUCTION_WORK_OF_SUPERSTRUCTURE,
            self::CONSTRUCTION_COMPLETION_CERTIFICATE_APPLICATION,
            self::APPROVAL_LETTER_FROM_BUILDING_CONTRACTOR,
            self::REGARDING_CONSTRUCTION_COMPLETION_CERTIFICATE => FileTypeEnum::APPLICATION,

            //notice enums
            self::NOTICE_ISSUED_IN_THE_NAME_OF_SANGHIAR,
            self::REGARDING_SENDING_DETAILS,
            self::FIFTEEN_DAYS_NOTICE_ADJOURNED,
            self::REVISED_SUPERSTRUCTURE_PERMIT => FileTypeEnum::NOTICE,
            //bond enums
            self::FIFTEEN_DAY_GRACE_PERIOD_FOR_MAP_PASS,
            self::SARZAMIN_MUCHULKA => FileTypeEnum::BOND,
            //report enums
            self::BUILDING_DESIGN_DETAILS,
            self::BUILDING_COMPLIANCE_CHECKLIST,
            self::TECHNICAL_REPORT,
            self::CONSTRUCTION_SUPERVISION_REPORT_UP_TO_PLINTH_LEVEL,
            self::THE_TECHNICIAN_WHO_COMPLETED_THE_FIRST_PHASE_OF_WORK_REPORT,
            self::CONSULTANTS_REPORT_ON_COMPLETION_OF_FIRST_PHASE,
            self::THE_TECHNICIAN_WHO_COMPLETED_THE_SECOND_PHASE_OF_WORK_REPORT,
            self::CONSULTANTS_REPORT_ON_COMPLETION_OF_SECOND_PHASE,
            self::CONSTRUCTION_SUPERVISION_REPORT_UPTO_SUPERSTRUCTURE => FileTypeEnum::REPORT,

            //agreement
            self::AGREEMENT_LETTER_BETWEEN_SUPERVISOR_CONSULTANT_AND_LANDLORD,
            self::AGREEMENT_LETTER_HOMEOWNER_AND_BUILDER_CONTRACTOR => FileTypeEnum::AGREEMENT,

            //order
            self::GRANTING_PERMISSION_FOR_CONSTRUCTION_UP_TO_THE_PLINTH_LEVEL_OF_THE_HOUSE,
            self::REGARDING_SUPERSTRUCTURE_PERMIT,
            self::REVISED_SUPERSTRUCTURE_PERMIT_ORDER,
            self::HOUSE_MAP_NAMSARI => FileTypeEnum::ORDER,
            //certificate enums
            self::PERMISSION_LETTER_FOR_CONSTRUCTION_WORK_UP_TO_PLINTH_LEVEL,
            self::PERMANENT_BUILDING_PERMIT_FOR_SUPERSTRUCTURE,
            self::MAP_CERTIFICATE,
            self::BUILDING_COMPLETION_CERTIFICATE => FileTypeEnum::CERTIFICATE,

            //registration
            self::REGARDING_FEES_AND_REGISTRATION => FileTypeEnum::REGISTRATION,

            //heir
            self::HEIR => FileTypeEnum::HEIR,
            //permission enums
            self::PERMISSION => FileTypeEnum::PERMISSION,
        };
    }

    public function type(): EMapFormFillerTypeEnum
    {
        return self::getType($this);
    }

    public static function getType(self $value): EMapFormFillerTypeEnum
    {
        return match ($value) {
            //consultant
            self::TECHNICIAN_APPROVAL,
            self::BUILDING_COMPLIANCE_CHECKLIST,
            self::APPROVAL_LETTER_FROM_BUILDING_CONTRACTOR,
            self::BUILDING_DESIGN,
            self::STRUCTURAL_DETAIL,
            self::DESIGN_RELATED,
            self::ELECTRICAL_DESIGN,
            self::ENGINEER_APPROVAL,
            self::BUILDING_DESIGN_DETAILS,
            self::MAP_PASS_FOR_BUILDING,
            self::AGREEMENT_LETTER_BETWEEN_SUPERVISOR_CONSULTANT_AND_LANDLORD,
            self::CONSULTANTS_REPORT_ON_COMPLETION_OF_FIRST_PHASE,
            self::CONSULTANTS_REPORT_ON_COMPLETION_OF_SECOND_PHASE,
            self::CONSTRUCTION_SUPERVISION_REPORT_UPTO_SUPERSTRUCTURE,
            self::AGREEMENT_LETTER_HOMEOWNER_AND_BUILDER_CONTRACTOR => EMapFormFillerTypeEnum::ORGANIZATION,

            //municipal
            self::REGARDING_FEES_AND_REGISTRATION,
            self::SARZAMIN_MUCHULKA,
            self::NOTICE_ISSUED_IN_THE_NAME_OF_SANGHIAR,
            self::FIFTEEN_DAYS_NOTICE_ADJOURNED,
            self::REGARDING_SENDING_DETAILS,
            self::REVISED_SUPERSTRUCTURE_PERMIT,
            self::FIFTEEN_DAY_GRACE_PERIOD_FOR_MAP_PASS,
            self::TECHNICAL_REPORT,
            self::THE_TECHNICIAN_WHO_COMPLETED_THE_FIRST_PHASE_OF_WORK_REPORT,
            self::THE_TECHNICIAN_WHO_COMPLETED_THE_SECOND_PHASE_OF_WORK_REPORT,
            self::GRANTING_PERMISSION_FOR_CONSTRUCTION_UP_TO_THE_PLINTH_LEVEL_OF_THE_HOUSE,
            self::REGARDING_SUPERSTRUCTURE_PERMIT,
            self::REVISED_SUPERSTRUCTURE_PERMIT_ORDER,
            self::HOUSE_MAP_NAMSARI,
            self::PERMISSION_LETTER_FOR_CONSTRUCTION_WORK_UP_TO_PLINTH_LEVEL,
            self::PERMANENT_BUILDING_PERMIT_FOR_SUPERSTRUCTURE,
            self::MAP_CERTIFICATE,
            self::BUILDING_COMPLETION_CERTIFICATE => EMapFormFillerTypeEnum::OFFICE,

            //house owner
            self::CONSTRUCTION_COMPLETION_CERTIFICATE_APPLICATION,
            self::REGARDING_PERMISSION_FOR_CONSTRUCTION_WORK_OF_SUPERSTRUCTURE,
            self::HEIR,
            self::CONSTRUCTION_SUPERVISION_REPORT_UP_TO_PLINTH_LEVEL,
            self::PERMISSION,
            self::MAP_ACCEPTANCE,
            self::REGARDING_CONSTRUCTION_COMPLETION_CERTIFICATE => EMapFormFillerTypeEnum::OWNER,
        };
    }

    public static function getAllValues(): Collection
    {
        return collect(self::cases())->pluck('value');
    }

    public static function getAllVerifiedField(): Collection
    {
        return collect(self::cases())->filter(function ($notice) {
            return $notice->showInMapVerification();
        })->pluck('value');
    }
}

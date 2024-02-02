<?php

namespace Modules\Plan\Enums;

enum PlanTemplateTypeEnum: string
{
    case MANDATE = "mandate";
    case COMMENT_ORDER = "comment_order";
    case BANK_ACCOUNT_OPERATION_RECOMMENDATION = "bank_account_operation_recommendation";
    case PLAN_EXTENSION = "plan_extension";
    case SCHEDULE_3 = "schedule_3";
    case SCHEDULE_4 = "schedule_4";
    case SCHEDULE_5 = "schedule_5";
    case SCHEDULE_6 = "schedule_6";
    case PLAN_MONITORING_REPORT = "plan_monitoring_report";
    case PLAN_SUPERVISION_MONITORING_REPORT = "plan_supervision_monitoring_report";
    case SAMPLE_MANDATE = "sample_mandate";
    case PROJECT_AGREEMENT_FORM = "project_agreement_form";
    case REGARDING_PLANNING_AGREEMENT_PROVIDING_SUBMISSIONS = "regarding_planning_agreement_providing_submissions";

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::MANDATE => 'कार्यादेश',
            self::COMMENT_ORDER => 'टिप्पणी र आदेश',
            self::BANK_ACCOUNT_OPERATION_RECOMMENDATION => 'बैंक खाता सन्चालन सिफारिस',
            self::PLAN_EXTENSION => 'योजना म्याद थप',
            self::SCHEDULE_3 => 'अनुसूची ३',
            self::SCHEDULE_4 => 'अनुसूची ४',
            self::SCHEDULE_5 => 'अनुसूची ५',
            self::SCHEDULE_6 => 'अनुसूची ६',
            self::PLAN_MONITORING_REPORT => 'योजना अनुगमन प्रतिवेदन',
            self::PLAN_SUPERVISION_MONITORING_REPORT => 'योजना सुपरीवेक्षण तथा अनुगमन प्रतिवेदन',
            self::SAMPLE_MANDATE => 'नमुना कार्यादेश',
            self::PROJECT_AGREEMENT_FORM => 'योजना सम्झौता फारम',
            self::REGARDING_PLANNING_AGREEMENT_PROVIDING_SUBMISSIONS => 'योजना सम्झौता गरी पेश्की उपलब्ध गराउने सम्बन्धमा'
        };
    }
}

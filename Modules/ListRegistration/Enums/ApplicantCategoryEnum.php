<?php

namespace Modules\ListRegistration\Enums;

enum ApplicantCategoryEnum: string
{
    case PERSON = 'person';
    case ORGANIZATION = 'organization';
    case SUPPLIER = 'supplier';
    case CONTRACTOR = 'contractor';
    case CONSULTANT = 'consultant';
    case SERVICE_PROVIDER = 'service_provider';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::PERSON => 'व्यक्ति',
            self::ORGANIZATION => 'संस्था',
            self::SUPPLIER => 'आपूर्तिकर्ता',
            self::CONTRACTOR => 'निर्माण ब्यबसायी',
            self::CONSULTANT => 'परामर्शदाता',
            self::SERVICE_PROVIDER => 'सेवा प्रदायक'
        };
    }
}

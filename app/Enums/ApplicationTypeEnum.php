<?php

namespace App\Enums;

enum ApplicationTypeEnum: string
{
    case MAP_ACCEPTANCE = 'map acceptance';
    case TECHNICIAN_APPROVAL = 'technician approval';
    case ENGINEER_APPROVAL = 'engineer approval';
    case MAP_PASS_FOR_BUILDING = 'map pass for building';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::MAP_ACCEPTANCE => 'भवन निर्माण सहिता अनुसार नक्शा / डिजाईनको लागि दरखास्त फाराम',
            self::TECHNICIAN_APPROVAL => 'नक्सा बनाउने प्राविधिकद्वारा मन्जुरी पत्र',
            self::ENGINEER_APPROVAL => 'भवन डिजाईन गर्ने प्राविधिकद्वारा मन्जुरी पत्र',
            self::MAP_PASS_FOR_BUILDING => 'भवन निर्माणको लागि नक्सापास सम्बन्धमा',
        };
    }
}

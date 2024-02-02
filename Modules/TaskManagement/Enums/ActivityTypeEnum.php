<?php

namespace Modules\TaskManagement\Enums;

enum ActivityTypeEnum: string
{
    case DAILY = 'daily';
    case MONTHLY = 'monthly';
    case TRI_MONTHLY = 'tri_monthly';
    case QUARTERLY = 'quarterly';
    case ANNUALLY = 'annually';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::DAILY => 'दैनिक',
            self::MONTHLY => 'मासिक',
            self::TRI_MONTHLY => 'त्रैमासिक',
            self::QUARTERLY => 'चौमासिक',
            self::ANNUALLY => 'वार्षिक'
        };
    }
}

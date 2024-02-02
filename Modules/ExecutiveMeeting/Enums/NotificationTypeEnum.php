<?php

namespace Modules\ExecutiveMeeting\Enums;

enum NotificationTypeEnum: string
{
    case ONE_TIME = 'one time';
    case WEEKLY = 'weekly';
    case MONTHLY = 'monthly';
    case YEARLY = 'yearly';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::ONE_TIME => 'एकपटक',
            self::WEEKLY => 'सप्ताहिक',
            self::MONTHLY => 'मासिक',
            self::YEARLY => 'वार्षिक',
        };
    }
}

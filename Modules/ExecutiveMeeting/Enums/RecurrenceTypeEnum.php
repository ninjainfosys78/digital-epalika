<?php

namespace Modules\ExecutiveMeeting\Enums;

enum RecurrenceTypeEnum: string
{
    case EMERGENCY  = 'emergency';
    case NO_RECURRENCE = 'no_recurrence';
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
            self::EMERGENCY => 'आकस्मिक',
            self::NO_RECURRENCE => 'एक पटक',
            self::WEEKLY => 'साप्ताहिक',
            self::MONTHLY => 'मासिक',
            self::YEARLY => 'वार्षिक',
        };
    }
}

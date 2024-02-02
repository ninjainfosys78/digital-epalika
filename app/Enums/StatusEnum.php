<?php

namespace App\Enums;

enum StatusEnum: string
{
    case PENDING = 'pending';
    case GIVEN = 'given';
    case ELIGIBILITY_FOR_MEETING = 'eligibility_for_meeting';
    case READY_FOR_PRINT = 'ready_for_print';
    case APPROVE = 'approve';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::PENDING => 'Pending',
            self::READY_FOR_PRINT => 'Ready for print',
            self::ELIGIBILITY_FOR_MEETING => 'Eligibility for meeting ',
            self::GIVEN => 'Given',
            self::APPROVE => 'Approve',
        };
    }
}

<?php

namespace App\Enums;

enum AttendanceEnum: string
{
    case ABSENT = 'absent';
    case PRESENT = 'present';
    case LATE = 'late';


    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::ABSENT => 'Absent',
            self::PRESENT => 'Present',
            self::LATE => 'Late',
        };
    }
}

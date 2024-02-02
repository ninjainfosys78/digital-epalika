<?php

namespace Modules\GrievanceHandling\Enums;

enum GrievanceMediumEnum: string
{
    case EMAIL = 'email';
    case FAX = 'fax';
    case LETTER = 'letter';
    case CALL = 'call';
    case SYSTEM = 'system';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::EMAIL => 'इमेल',
            self::FAX => 'फ्याक्स',
            self::LETTER => 'पत्र',
            self::CALL => 'फोन',
            self::SYSTEM => 'वेबसाइट',
        };
    }
}

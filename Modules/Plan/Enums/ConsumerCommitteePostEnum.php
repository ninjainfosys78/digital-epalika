<?php

namespace Modules\Plan\Enums;

enum ConsumerCommitteePostEnum: string
{
    case CHAIRMAN = 'chairman';
    case VICE_CHAIRMAN = 'vice_chairman';
    case TREASURER = 'treasurer';
    case SECRETARY = 'secretary';
    case MEMBER = 'member';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::CHAIRMAN => 'अध्यक्ष',
            self::VICE_CHAIRMAN => 'उपाध्यक्ष',
            self::TREASURER => 'कोषाध्यक्ष',
            self::SECRETARY => 'सचिव',
            self::MEMBER => 'सदस्य',
        };
    }
}

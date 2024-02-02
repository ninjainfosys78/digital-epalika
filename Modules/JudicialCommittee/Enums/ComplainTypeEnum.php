<?php

namespace Modules\JudicialCommittee\Enums;

enum ComplainTypeEnum: string
{
    case ORGANIZATIONAL = 'organizational';
    case PERSONAL = 'personal';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::ORGANIZATIONAL => 'संस्थागत',
            self::PERSONAL => 'व्यक्तिगत'
        };
    }
}

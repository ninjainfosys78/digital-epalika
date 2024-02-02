<?php

namespace Modules\BusinessRegistration\Enums;

enum BusinessTypeEnum: string
{
    case NEW_REGISTRATION = 'new_registration';
    case RENEWAL = 'renewal';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::NEW_REGISTRATION => 'नयाँ दर्ता',
            self::RENEWAL => 'नवीकरण',
        };
    }
}

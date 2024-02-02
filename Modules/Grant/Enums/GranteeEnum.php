<?php

namespace Modules\Grant\Enums;

enum GranteeEnum: string
{
    case FARMER = 'farmer';
    case COOPERATIVE = 'cooperative';
    case GROUP = 'group';
    case ENTERPRISE = 'enterprise';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::FARMER => 'कृषक',
            self::COOPERATIVE => 'सहकारी',
            self::GROUP => 'समूह',
            self::ENTERPRISE => 'उधम',
        };
    }
}

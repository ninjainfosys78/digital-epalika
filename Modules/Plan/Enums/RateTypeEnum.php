<?php

namespace Modules\Plan\Enums;

enum RateTypeEnum: string
{
    case PERCENT = 'percent';
    case FLAT = 'flat';


    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::PERCENT => 'Percent',
            self::FLAT => 'Flat',
        };
    }
}

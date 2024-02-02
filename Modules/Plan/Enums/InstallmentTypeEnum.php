<?php

namespace Modules\Plan\Enums;

enum InstallmentTypeEnum: string
{
    case FIRST = 'first';
    case SECOND = 'second';
    case THIRD = 'third';
    case FOURTH = 'fourth';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::FIRST => 'पहिलो',
            self::SECOND => 'दोस्रो',
            self::THIRD => 'तेस्रो',
            self::FOURTH => 'चौथो',
        };
    }
}

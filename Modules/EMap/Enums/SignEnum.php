<?php

namespace Modules\EMap\Enums;

enum SignEnum: string
{
    case LESS_THAN = 'less_than';
    case GREATER_THAN = 'greater_than';
    case LESS_THAN_EQUAL = 'less_than_equal';
    case GREATER_THAN_EQUAL = 'greater_than_equal';
    case EQUAL = 'equal';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::LESS_THAN => '<',
            self::GREATER_THAN => '>',
            self::LESS_THAN_EQUAL => '<=',
            self::GREATER_THAN_EQUAL => '>=',
            self::EQUAL => '=',
        };
    }
}

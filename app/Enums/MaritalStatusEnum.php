<?php

namespace App\Enums;

enum MaritalStatusEnum: string
{
    case MARRIED = 'married';
    case UNMARRIED = 'unmarried';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::MARRIED => 'वैवाहिक',
            self::UNMARRIED => 'अविवाहित',
        };
    }
}

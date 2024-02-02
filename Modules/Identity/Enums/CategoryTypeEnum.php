<?php

namespace Modules\Identity\Enums;

enum CategoryTypeEnum: string
{
    case CATEGORY_A = 'A';
    case CATEGORY_B = 'B';
    case CATEGORY_C = 'C';
    case CATEGORY_D = 'D';

    public function label(): string
    {
        return self::getLabel($this);
    }


    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::CATEGORY_A => 'क',
            self::CATEGORY_B => 'ख',
            self::CATEGORY_C => 'ग',
            self::CATEGORY_D => 'घ',
        };
    }    public function labelEn(): string
    {
        return self::getLabelEn($this);
    }


    public static function getLabelEn(self $value): string
    {
        return match ($value) {
            self::CATEGORY_A => 'KA',
            self::CATEGORY_B => 'KHA',
            self::CATEGORY_C => 'GA',
            self::CATEGORY_D => 'GHA',
        };
    }

    public function color(): string
    {
        return self::getColor($this);
    }
    public static function getColor(self $value): string
    {
        return match ($value) {
            self::CATEGORY_A => 'white',
            self::CATEGORY_B => 'yellow',
            self::CATEGORY_C, self::CATEGORY_D => 'black',
        };
    }
    public function backgroundColor(): string
    {
        return self::getBackgroundColor($this);
    }
    public static function getBackgroundColor(self $value): string
    {
        return match ($value) {
            self::CATEGORY_A => '#D2042D',
            self::CATEGORY_B => 'blue',
            self::CATEGORY_C => 'yellow',
            self::CATEGORY_D => 'white',
        };
    }
}

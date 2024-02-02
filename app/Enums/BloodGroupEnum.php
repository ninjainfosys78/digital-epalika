<?php

namespace App\Enums;

enum BloodGroupEnum: string
{
    case NA = 'n/a';
    case O_POSITIVE = 'o+';
    case O_NEGATIVE = 'o-';
    case A_NEGATIVE = 'a-';
    case A_POSITIVE = 'a+';
    case B_POSITIVE = 'b+';
    case B_NEGATIVE = 'b-';
    case AB_POSITIVE = 'ab+';
    case AB_NEGATIVE = 'ab-';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::NA => 'N/A',
            self::O_NEGATIVE => 'ओ नेगेटिभ',
            self::O_POSITIVE => 'ओ पोजेटिभ',
            self::A_NEGATIVE => 'ए नेगेटिभ',
            self::A_POSITIVE => 'ए पोजेटिभ',
            self::B_POSITIVE => 'बि पोजेटिभ',
            self::B_NEGATIVE => 'बि नेगेटिभ',
            self::AB_POSITIVE => 'एबि पोजेटिभ',
            self::AB_NEGATIVE => 'एबि नेगेटिभ',
        };
    }public function labelEn(): string
    {
        return self::getLabelEn($this);
    }

    public static function getLabelEn(self $value): string
    {
        return match ($value) {
            self::NA => 'N/A',
            self::O_POSITIVE => 'O+',
            self::O_NEGATIVE => 'O-',
            self::A_NEGATIVE => 'A-',
            self::A_POSITIVE => 'A+',
            self::B_POSITIVE => 'B+',
            self::B_NEGATIVE => 'B-',
            self::AB_POSITIVE => 'AB+',
            self::AB_NEGATIVE => 'AB-',
        };
    }
}

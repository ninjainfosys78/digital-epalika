<?php

namespace App\Enums;

enum FamilyRelationEnum: string
{
    case FATHER = 'father';
    case MOTHER = 'mother';
    case SON = 'son';
    case DAUGHTER = 'daughter';
    case GRANDSON = 'grandson';
    case GRANDDAUGHTER = 'granddaughter';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::FATHER => 'बुबा',
            self::MOTHER => 'आमा',
            self::SON => 'छोरा',
            self::DAUGHTER => 'छोरी',
            self::GRANDSON => 'नाति',
            self::GRANDDAUGHTER => 'नातिनी',
        };
    }
}

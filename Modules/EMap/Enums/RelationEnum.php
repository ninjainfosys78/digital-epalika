<?php

namespace Modules\EMap\Enums;

enum RelationEnum: string
{
    case SELF = 'self';
    case SON_DAUGHTER = 'son daughter';
    case MOTHER_FATHER = 'mother father';
    case RELATIVE = 'relative';
    case WORK_ONLY = 'work only';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::SELF => 'स्वयम',
            self::SON_DAUGHTER => 'छोरा/छोरी',
            self::MOTHER_FATHER => 'आमा/बुवा',
            self::RELATIVE => 'नातेदार',
            self::WORK_ONLY => 'कामको मात्र',
        };
    }

    public static function getValuesWithLabels(): array
    {
        $valuesWithLabels = [];

        foreach (self::cases() as $value) {
            $valuesWithLabels[] = [
                'value' => $value,
                'label' => $value->label(),
            ];
        }

        return $valuesWithLabels;
    }
}

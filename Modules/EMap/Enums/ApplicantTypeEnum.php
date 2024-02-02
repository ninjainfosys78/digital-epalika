<?php

namespace Modules\EMap\Enums;

enum ApplicantTypeEnum: string
{
    case HOUSE_OWNER = 'house owner';
    case LAND_OWNER = 'land owner';
    case IN_CASE_OF_INHERITANCE = 'inheritance';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::LAND_OWNER => 'जग्गाधनी',
            self::HOUSE_OWNER => 'घरधनी',
            self::IN_CASE_OF_INHERITANCE => 'वारेश भएमा',
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

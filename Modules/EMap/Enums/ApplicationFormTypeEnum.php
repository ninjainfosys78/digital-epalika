<?php

namespace Modules\EMap\Enums;

enum ApplicationFormTypeEnum: string
{
    case MAP_REGISTRATION = 'map_registration';
    case MAP_VERIFIED = 'map_verified';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::MAP_REGISTRATION => 'नक्सा दर्ता',
            self::MAP_VERIFIED => 'नक्सा प्रमाणित',
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

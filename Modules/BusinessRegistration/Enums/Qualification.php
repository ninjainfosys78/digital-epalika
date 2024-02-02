<?php

namespace Modules\BusinessRegistration\Enums;

enum Qualification: string
{
    case ILLITERATE = 'illiterate';
    case LITERATE = 'literate';
    case FIFTH_PASS = 'fifth pass';
    case EIGHTH_PASS = 'eighth pass';
    case TENTH_PASS = 'tenth pass';
    case TWELVETH_PASS = 'twelveth pass';
    case GRADUATE = 'graduate';
    case POST_GRADUATE = 'post graduate';
    case OTHERS = 'others';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::ILLITERATE => 'अशिक्षित',
            self::LITERATE => 'साक्षर',
            self::FIFTH_PASS => 'पाँचौं पास',
            self::EIGHTH_PASS => 'आठौं पास',
            self::TENTH_PASS => 'दस पास',
            self::TWELVETH_PASS => 'बाह्र पास',
            self::GRADUATE => 'स्नातक',
            self::POST_GRADUATE => 'स्नातकोत्तर',
            self::OTHERS => 'अन्य',
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

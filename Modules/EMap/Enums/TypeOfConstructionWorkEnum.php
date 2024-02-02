<?php

namespace Modules\EMap\Enums;

enum TypeOfConstructionWorkEnum: string
{
    case NEW_HOME_CONSTRUCTION = 'new home construction';
    case ADD_FLOOR = 'add floor';
    case DEMOLISH_OLD_HOUSE_AND_REBUILD_IT = 'demolish old house and rebuild it';
    case MORE_HOUSE_CONSTRUCTION = 'more house construction';
    case BUILDING_CONCRETE_WALLS = 'building concrete walls';
    case CHANGE_CORNER = 'change corner';
    case ROOFING = 'Roofing';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::NEW_HOME_CONSTRUCTION => 'नयाँ घर निर्माण',
            self::ADD_FLOOR => 'तल्ला थप्ने',
            self::DEMOLISH_OLD_HOUSE_AND_REBUILD_IT => 'साविक घर भत्काई पुनः निर्माण गर्ने',
            self::MORE_HOUSE_CONSTRUCTION => 'थप घर निर्माण',
            self::BUILDING_CONCRETE_WALLS => 'जग्गामा पक्की पर्खाल लगाउने',
            self::CHANGE_CORNER => 'घरको मोहोडा फेर्ने',
            self::ROOFING => 'घरको छाना फेर्ने',
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

<?php

namespace Modules\EMap\Enums;

enum RoadTypeEnum: string
{
    case BLACK_ROAD = 'black road';
    case GRAVEL_OR_SECTION_SMITH_ROAD = 'gravel or section smith road';
    case WASHED_AND_WEATHERED_ROADS = 'washed and weathered roads';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::BLACK_ROAD => 'कालोपत्रे सडक',
            self::GRAVEL_OR_SECTION_SMITH_ROAD => 'ग्राभेल वा खण्ड स्मीथ सडक',
            self::WASHED_AND_WEATHERED_ROADS => 'धुले तथा मौसमी सडक',
        };
    }
}

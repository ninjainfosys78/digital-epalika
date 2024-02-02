<?php

namespace Modules\EMap\Enums;

enum RoadConditionEnum: string
{
    case GOOD = 'good';
    case FAIR = 'fair';
    case POOR = 'poor';
    case UNDER_CONSTRUCTION = 'under construction';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::GOOD => 'राम्रो',
            self::FAIR => 'ठिकै',
            self::POOR => 'खराब ',
            self::UNDER_CONSTRUCTION => 'निर्माणाधीन'
        };
    }
}

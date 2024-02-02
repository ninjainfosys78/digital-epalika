<?php

namespace Modules\EMap\Enums;

enum FourSideParticularEnum: string
{
    case TOWARDS = 'toward';
    case STANDARD_SETBACK = 'standard setback';
    case ACTUAL_SETBACK = 'actual setback';
    case ROAD_WIDTH = 'road width';
    case HAS_DOOR_WINDOW = 'has door window';
    case HAS_HIGH_TENSION_LINE = 'has high tension line';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::TOWARDS => 'तर्फ (अगाडी, पछाडी, बायाँ, दायाँ)',
            self::STANDARD_SETBACK => 'Standard Setback',
            self::ACTUAL_SETBACK => 'Actual Setback (उक्त दिशाको सिमानाबाट प्रस्तावित भवनको बाहिरी भागसम्मको दुरी)',
            self::ROAD_WIDTH => 'सडक भएमा सडकको चौडाई',
            self::HAS_DOOR_WINDOW => 'उक्त दिशामा झ्याल र ढोका छ या छैन',
            self::HAS_HIGH_TENSION_LINE => 'हाइ टेन्सन लाइन भएमा सोको किनाराबाट दुरी',
        };
    }
}

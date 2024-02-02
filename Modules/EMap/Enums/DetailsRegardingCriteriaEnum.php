<?php

namespace Modules\EMap\Enums;

enum DetailsRegardingCriteriaEnum: string
{
    case ROAD_JURISDICTION = 'road jurisdiction';
    case SET_BACK = 'set back';
    case GROUND_COVERAGE_RATIO = 'ground coverage ratio';
    case FAR = 'far';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::ROAD_JURISDICTION => 'सडक अधिकार क्षेत्र',
            self::SET_BACK => 'सेट व्याक (सडक तर्फको)',
            self::GROUND_COVERAGE_RATIO => 'जि.सि.आर. (Ground Coverage Ratio)',
            self::FAR => 'FAR',
        };
    }

    public function remarks(): ?string
    {
        return self::gerRemarks($this);
    }

    public static function gerRemarks(self $value): ?string
    {
        return match ($value) {
            self::ROAD_JURISDICTION, self::SET_BACK, self::FAR => null,
            self::GROUND_COVERAGE_RATIO => 'प्रतिशतमा',
        };
    }



    public function getFormula(self $value)
    {
        switch ($value) {
            case (self::FAR):

            default:
        }
    }
}

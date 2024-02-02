<?php

namespace Modules\EMap\Enums;

enum BuildingDetailEnum: string
{
    case BUILDING_CATEGORY = 'building category';
    case PLINTH_AREA = 'plinth area';
    case LENGTH = 'length';
    case BREADTH = 'breadth';
    case STOREY_COUNT = 'storey count';
    case HEIGHT = 'height';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::BUILDING_CATEGORY => 'भवनको वर्ग',
            self::PLINTH_AREA => 'प्लिन्थको क्षेत्रफल, (जमिन तलाको)',
            self::LENGTH => 'भवनको लम्बाई',
            self::BREADTH => 'भवनको चौडाई',
            self::STOREY_COUNT => 'भवनको तला संख्या',
            self::HEIGHT => 'भवनको कूल उचाई',
        };
    }
}

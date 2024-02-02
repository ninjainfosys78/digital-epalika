<?php

namespace Modules\EMap\Enums;

enum OfficeTypeEnum: string
{
    case RURAL_MUNICIPALITY = 'rural municipality';
    case MUNICIPALITY = 'municipality';
    case SUB_METROPOLITAN = 'sub metropolitan';
    case METROPOLITAN = 'metropolitan';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::RURAL_MUNICIPALITY => 'गाउपलिका',
            self::MUNICIPALITY => 'नगरपालिका',
            self::SUB_METROPOLITAN => 'उप महानगरपालिका',
            self::METROPOLITAN => 'महानगरपालिका',
        };
    }
}

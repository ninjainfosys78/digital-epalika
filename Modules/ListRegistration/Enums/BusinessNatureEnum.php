<?php

namespace Modules\ListRegistration\Enums;

enum BusinessNatureEnum: string
{
    case GOODS_SUPPLY = 'goods_supply';
    case CONSTRUCTION_WORK = 'construction_work';
    case CONSULTING_SERVICE = 'consulting_service';
    case OTHER_SERVICE = 'other_service';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::GOODS_SUPPLY => 'मालसामान आपूर्ति',
            self::CONSTRUCTION_WORK => 'निर्माण कार्य',
            self::CONSULTING_SERVICE => 'परामर्श सेवा',
            self::OTHER_SERVICE => 'अन्य सेवा'
        };
    }
}

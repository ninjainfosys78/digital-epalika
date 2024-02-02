<?php

namespace Modules\EMap\Enums;

enum LandOwnerTypeEnum: string
{
    case OWN_IT = 'Own it';
    case FROM_APPROVAL = 'from approval';
    case FROM_OWN_AND_SOME_CONCESSIONS = 'From own and some concessions';
    case COMBINED = 'combined';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::OWN_IT => 'आफ्नो स्वामित्वमा',
            self::FROM_APPROVAL => 'मन्जुरीनामा बाट',
            self::FROM_OWN_AND_SOME_CONCESSIONS => 'आफ्नै र केही मन्जुरीनामा बाट',
            self::COMBINED => 'संयुक्त',
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

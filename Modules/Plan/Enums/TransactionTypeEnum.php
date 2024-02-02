<?php

namespace Modules\Plan\Enums;

enum TransactionTypeEnum: string
{
    case CONTINGENCY = 'contingency';
    case MAINTENANCE = 'maintenance';
    case TDS = 'tds';
    case INSTALLMENT = 'installment';
    case ADVANCE = 'advance';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::CONTINGENCY => 'कन्टिन्जेन्सी',
            self::MAINTENANCE => 'मेन्टेनेन्स',
            self::TDS => 'टी डी एस',
            self::INSTALLMENT => 'किस्ता',
            self::ADVANCE => 'पेश्की',
        };
    }
}

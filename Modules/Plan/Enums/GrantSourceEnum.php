<?php

namespace Modules\Plan\Enums;

enum GrantSourceEnum: string
{
    case FROM_FEDERAL = 'from_federal';
    case FROM_PROVINCE = 'from_province';
    case FROM_LOCAL_LEVEL = 'from_local_level';
    case FROM_NGO = 'from_ngo';
    case FROM_FOREIGN_DONOR = 'from_foreign_donor';
    case FROM_CONSUMER_COMMITTEE = 'from_consumer_committee';
    case FROM_PUBLIC_DONATION = 'from_public_donation';
    case FROM_OTHER_BODIES = 'from_other_bodies';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::FROM_FEDERAL => 'संघीयबाट',
            self::FROM_PROVINCE => 'प्रदेशबाट',
            self::FROM_LOCAL_LEVEL => 'स्थानीय तहबाट',
            self::FROM_NGO => 'गैरसरकारी सघंसंस्थाबाट',
            self::FROM_FOREIGN_DONOR => 'विदेशी दात्री सघंसंस्थाबाट',
            self::FROM_CONSUMER_COMMITTEE => 'उपभोक्ता समितिबाट',
            self::FROM_PUBLIC_DONATION => 'जनश्रमदान बाट',
            self::FROM_OTHER_BODIES => 'अन्य निकायबाट',
        };
    }
}

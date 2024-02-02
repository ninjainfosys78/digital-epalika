<?php

namespace Modules\EMap\Enums;

enum FileTypeEnum: string
{
    case APPLICATION = 'application';
    case NOTICE = 'notice';
    case BOND = 'bond';
    case REPORT = 'report';
    case AGREEMENT = 'agreement';
    case ORDER = 'order';
    case CERTIFICATE = 'certificate';
    case HEIR = 'heir';
    case PERMISSION = 'permission';
    case REGISTRATION = 'registration';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::APPLICATION => 'निबेदन',
            self::NOTICE => 'सूचना',
            self::BOND => 'मुचुल्का',
            self::REPORT => 'प्रतिबेदन',
            self::AGREEMENT => 'सम्झौता',
            self::ORDER => 'आदेश',
            self::CERTIFICATE => 'प्रमाणपत्र',
            self::HEIR => 'वारेसनामा',
            self::PERMISSION => 'मन्जुरीनामा',
            self::REGISTRATION => 'दर्ता तथा दस्तुर',
        };
    }
}

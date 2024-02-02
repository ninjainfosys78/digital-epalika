<?php

namespace App\Enums;

enum UserTypeEnum: string
{
    case CONSUMER = 'consumer';
    case ORGANIZATION = 'organization';


    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::CONSUMER => 'सेवाग्राही',
            self::ORGANIZATION => 'परामर्शदाता',
        };
    }
}

<?php

namespace Modules\EMap\Enums;

enum CategorizationEnum: string
{
    case A = 'a';
    case B = 'b';
    case C = 'c';
    case D = 'd';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::A => 'क वर्ग',
            self::B => 'ख वर्ग',
            self::C => 'ग वर्ग',
            self::D => 'घ वर्ग',
        };
    }
}

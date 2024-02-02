<?php

namespace Modules\EMap\Enums;

enum PostsEnum: string
{
    case DESIGNER = 'designer';
    case SUPERVISOR = 'supervisor';
    case CONTRACTOR = 'contractor';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::DESIGNER => 'डिजाइनर',
            self::SUPERVISOR => 'सुपरभाइजर',
            self::CONTRACTOR => 'ठेकेदार',
        };
    }
}

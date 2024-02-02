<?php

namespace App\Enums;

enum FormFieldEnum: string
{
    case TEXT = 'text';
    case NUMBER = 'number';
    case DATEPICKER = 'datepicker';
    case TABLE = 'table';
    case IMAGE = 'image';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::TEXT => 'Text',
            self::NUMBER => 'Number',
            self::DATEPICKER => 'Datepicker',
            self::TABLE => 'Table',
            self::IMAGE => 'Image',
        };
    }

    public function resolveType(): string
    {
        return self::getResolveType($this);
    }

    public static function getResolveType(self $value): ?string
    {
        return match ($value) {
            self::TEXT => 'text',
            self::NUMBER => 'number',
            self::DATEPICKER => 'date',
            self::TABLE => null,
            self::IMAGE => 'file',
        };
    }
}

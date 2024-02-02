<?php

namespace App\Enums;

enum BackgroundEnum: string
{
    case DANGER = 'bg-danger';
    case SUCCESS = 'bg-success';
    case PRIMARY = 'bg-primary';
    case INFO = 'bg-info';
    case DARK = 'bg-dark';
    case WARNING = 'bg-warning';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::DANGER => 'Danger',
            self::SUCCESS => 'Success',
            self::PRIMARY => 'Primary',
            self::INFO => 'Info',
            self::DARK => 'Dark',
            self::WARNING => 'Warning',
        };
    }
}

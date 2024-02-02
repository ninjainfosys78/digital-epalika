<?php

namespace Modules\EMap\Enums;

use Modules\EMap\Entities\DynamicForm;
use Modules\EMap\Entities\EMapTemplate;

enum FormTypeEnum: string
{
    case FILE = 'file';
    case FORM = 'form';
    case PAYMENT = 'payment';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::FILE => 'फाइल',
            self::FORM => 'फारम',
            self::PAYMENT => 'राजस्व',
        };
    }

    public function class(): string|null
    {
        return self::getClass($this);
    }

    public static function getClass(self $value): string|null
    {
        return match ($value) {
            self::FILE => get_class(new EMapTemplate()),
            self::FORM => get_class(new DynamicForm()),
            self::PAYMENT => null
        };
    }
}

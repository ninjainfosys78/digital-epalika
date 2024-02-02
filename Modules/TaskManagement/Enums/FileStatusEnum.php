<?php

namespace Modules\TaskManagement\Enums;

enum FileStatusEnum: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::PENDING => 'विचाराधीन',
            self::PROCESSING => 'काम भईराखेको',
            self::COMPLETED => 'सम्पन्न भईसकेको'
        };
    }
}

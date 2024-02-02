<?php

namespace Modules\Plan\Enums;

enum ProjectStatusEnum: string
{
    case NOT_STARTED = 'not_started';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::NOT_STARTED => 'शुरु नभएको',
            self::IN_PROGRESS => 'चालु अवस्थामा रहेको',
            self::COMPLETED => 'सम्पन्न भईसकेको',
        };
    }
}

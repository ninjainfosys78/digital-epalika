<?php

namespace Modules\EMap\Enums;

enum MapStatusEnum: string
{
    case ACCEPT = 'Accept';
    case REJECT = 'Reject';
    case COMPLETE = 'Complete';
    case UNSEEN = 'Unseen';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::ACCEPT => 'स्वीकार',
            self::REJECT => 'अस्वीकार',
            self::COMPLETE => 'सम्पन्न',
            self::UNSEEN => 'प्रक्रियामा',
        };
    }
}

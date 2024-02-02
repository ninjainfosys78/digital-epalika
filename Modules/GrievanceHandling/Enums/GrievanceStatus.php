<?php

namespace Modules\GrievanceHandling\Enums;

enum GrievanceStatus: string
{
    case UNSEEN = 'unseen';
    case INVESTIGATED = 'investigated';
    case REPLIED = 'replied';
    case CLOSED = 'closed';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::UNSEEN => 'नहेरिएको',
            self::INVESTIGATED => 'अनुसन्धान गरिदै',
            self::REPLIED => 'जवाफ दिएको',
            self::CLOSED => 'बन्द',
        };
    }
    public function color(): string
    {
        return self::getColor($this);
    }

    public static function getColor(self $value): string
    {
        return match ($value) {
            self::UNSEEN => 'bg-danger',
            self::INVESTIGATED => 'bg-info text-white',
            self::REPLIED => 'bg-success',
            self::CLOSED => 'bg-secondary',
        };
    }
}

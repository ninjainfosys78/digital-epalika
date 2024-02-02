<?php

namespace Modules\JudicialCommittee\Enums;

enum ComplainantDefendantTypeEnum: string
{
    case COMPLAINANT = 'complainant';
    case DEFENDANT = 'defendant';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::COMPLAINANT => 'वादी',
            self::DEFENDANT => 'प्रतिवादी'
        };
    }
}

<?php

namespace Modules\JudicialCommittee\Enums;

enum ComplaintApplicationStatusEnum: string
{
    case PENDING = 'pending';
    case RECOMMENDED = 'recommended';
    case COMPLETED = 'completed';
    case SOCIETY_CONCILIATED = 'society_conciliated';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::PENDING => 'फर्छ्यौट हुन बाँकी',
            self::RECOMMENDED => 'माथिल्लो निकायमा सिफारिस',
            self::COMPLETED => 'फर्छ्यौट',
            self::SOCIETY_CONCILIATED => 'समाज मै मिलापत्र'
        };
    }
}

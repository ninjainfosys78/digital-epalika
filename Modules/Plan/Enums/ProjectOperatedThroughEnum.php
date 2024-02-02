<?php

namespace Modules\Plan\Enums;

enum ProjectOperatedThroughEnum: string
{
    case CONSUMER_COMMITTEE = 'consumer_committee';
    case BID = 'bid';
    case SILWANDI = 'silwandi';
    case QUOTATION = 'quotation';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::CONSUMER_COMMITTEE => 'उपभोक्ता समिति',
            self::BID => 'बोलपत्र(टेन्डर)',
            self::SILWANDI => 'सिलवन्दी दरभाउपत्र',
            self::QUOTATION => 'दरभाउपत्र (कोटेसन)'
        };
    }
}

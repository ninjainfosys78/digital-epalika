<?php

namespace Modules\Plan\Enums;

enum BidSubmissionTypeEnum: string
{
    case MOBILIZATION = 'mobilization';
    case RUNNING_BILL = 'running_bill';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::MOBILIZATION => 'मोविलाईजेशन पेश्की',
            self::RUNNING_BILL => 'रनिङ विल पेश्की',
        };
    }
}

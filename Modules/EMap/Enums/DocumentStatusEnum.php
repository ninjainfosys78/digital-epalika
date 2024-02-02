<?php

namespace Modules\EMap\Enums;

enum DocumentStatusEnum: string
{
    case PENDING = 'pending';
    case REJECTED = 'rejected';
    case APPROVED = 'approved';
    case REVIEW = 'review';
    case NOT_APPLIED = 'not-applied';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::PENDING => 'Pending',
            self::REJECTED => 'Rejected',
            self::APPROVED => 'Approved',
            self::REVIEW => 'Review',
            self::NOT_APPLIED => 'Not Applied'
        };
    }
}

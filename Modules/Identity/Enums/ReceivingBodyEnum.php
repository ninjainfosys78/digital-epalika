<?php

namespace Modules\Identity\Enums;

enum ReceivingBodyEnum: string
{
    case LOCAL_BODY = 'local_body';
    case DISTRICT = 'district';
    case OTHER = 'other';


    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::LOCAL_BODY => 'पालिका',
            self::DISTRICT => 'जिल्ला',
            self::OTHER => 'अन्य',
        };
    }
}

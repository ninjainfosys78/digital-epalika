<?php

namespace App\Enums;

enum DesignationTypeEnum: string
{
    case CHAIRMAN = 'chairman';
    case SECRETARY = 'secretary';
    case TREASURER = 'Treasurer';
    case VICE_PRESIDENT = 'vice_president';
    case JOINT_SECRETARY = 'joint_secretary';
    case CO_TREASURER = 'co_treasurer';
    case MEMBER = 'Member';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::CHAIRMAN => 'अध्यक्ष',
            self::SECRETARY => 'सचिव',
            self::TREASURER => 'कोषाध्यक्ष',
            self::VICE_PRESIDENT => 'उपाध्यक्ष',
            self::JOINT_SECRETARY => 'सह-सचिव',
            self::CO_TREASURER => 'सह-कोषाध्यक्ष',
            self::MEMBER => 'सदस्य',
        };
    }
}

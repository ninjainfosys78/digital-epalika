<?php

namespace App\Enums;

enum FeatureTypeEnum: string
{
    case SMS = 'sms';
    case MAIL = 'mail';
    case PIN = 'pin';

    public function unique(): bool
    {
        return self::getUnique($this);
    }

    public static function getUnique(self $value): bool
    {
        return match ($value) {
            self::SMS, self::MAIL, self::PIN => true
        };
    }

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::SMS => 'एस.एम.एस',
            self::MAIL => 'ई-मेल',
            self::PIN => 'पिन',
        };
    }

    public function settingUrl(): string
    {
        return self::getSettingUrl($this);
    }

    public static function getSettingUrl(self $value): string
    {
        return match ($value) {
            self::SMS => route('admin.global.featureSetting.sms-setting'),
            self::MAIL => route('admin.global.featureSetting.mail-setting'),
            self::PIN => '',
        };
    }
}

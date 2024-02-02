<?php

namespace Modules\BusinessRegistration\Enums;

enum TemplateTypeEnum: string
{
    case APPLICATION_FORM = 'application_form';
    case REGISTRATION_BOOK = 'registration_book';
    case CERTIFICATE = 'certificate';
    case CUSTOMS = 'customs';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::APPLICATION_FORM => 'दर्ता/नवीकरण निवेदन फारम',
            self::REGISTRATION_BOOK => 'व्यवसाय कर दर्ता किताब',
            self::CERTIFICATE => 'व्यवसाय दर्ता प्रमाणपत्र',
            self::CUSTOMS => 'दस्तुर',
        };
    }
}

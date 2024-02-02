<?php

namespace Modules\GrievanceHandling\Enums;

enum GrievanceComplaintSeverity: string
{
    case SIMPLE = 'Simple';
    case PRIORITY = 'Priority';
    case HIGH_PRIORITY = 'High priority';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::SIMPLE => 'साधारण',
            self::PRIORITY => 'प्राथमिकता',
            self::HIGH_PRIORITY => 'उच्च प्राथमिकता',
        };
    }

    public static function getValuesWithLabels(): array
    {
        $valuesWithLabels = [];

        foreach (self::cases() as $value) {
            $valuesWithLabels[] = [
                'value' => $value,
                'label' => $value->label(),
            ];
        }

        return $valuesWithLabels;
    }
}

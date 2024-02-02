<?php

namespace Modules\Roaster\Enums;

enum TrainingTypeEnum: string
{
    case TRAINEE = 'trainee';
    case TECHNICAL_TRAINEE = 'technical_trainee';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::TRAINEE => 'किसानको लागि तालिम',
            self::TECHNICAL_TRAINEE => 'प्राविधिक प्रशिक्षार्थीको लागि तालिम',
        };
    }
}

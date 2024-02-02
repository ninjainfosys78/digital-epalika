<?php

namespace Modules\EMap\Enums;

enum BuildingUsageEnum: string
{
    case RESIDENTIAL = 'Residential';
    case PROFESSIONAL = 'Professional';
    case HEALTH = 'Health';
    case EDUCATION = 'Education';
    case GOVERNMENT_AND_SEMI_GOVERNMENT = 'Govt and Semi Govt';
    case BUILDING_WHERE_PEOPLE_GATHER = 'building where people gather';
    case INDUSTRY = 'Industry';
    case COMMERCIAL_BUILDING = 'Commercial building';
    case HOTEL = 'Hotel';
    case SERVICE_DELIVERY_DISTRIBUTION_FACILITIES = 'Service delivery and distribution facilities';
    case HAZARDOUS_MATERIAL_PREVENTION_BUILDING = 'Hazardous Materials Prevention Building';
    case APARTMENT = 'Apartment';
    case ASSOCIATION = 'Association';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::RESIDENTIAL => 'आवासीय',
            self::PROFESSIONAL => 'व्यवसायिक',
            self::HEALTH => 'स्वास्थ्य',
            self::EDUCATION => 'शिक्षा',
            self::GOVERNMENT_AND_SEMI_GOVERNMENT => 'सरकारी र अर्ध सरकारी',
            self::BUILDING_WHERE_PEOPLE_GATHER => 'मानिसहरु भेला हुने भवन',
            self::INDUSTRY => 'उद्धोग',
            self::COMMERCIAL_BUILDING => 'व्यवसायिक भवन',
            self::HOTEL => 'होटेल',
            self::SERVICE_DELIVERY_DISTRIBUTION_FACILITIES => 'सेवा वितरण र वितरण सुबिधा (स्वास्थ्य, खाद्य, उपयोगिता)',
            self::HAZARDOUS_MATERIAL_PREVENTION_BUILDING => 'खतरनाक सामग्री रोकथाम बिल्डिंग',
            self::APARTMENT => 'अपार्टमेन्ट',
            self::ASSOCIATION => 'संघ संस्था',
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

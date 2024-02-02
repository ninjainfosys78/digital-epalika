<?php

namespace Modules\Circular\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Circular\Entities\Registration;

trait RegistrationTrait
{
    public function getCircularSetting(): object|null
    {
        return DB::table('circular_settings')
            ->whereNull('deleted_at')
            ->latest()
            ->first();
    }
    public function getRegistrationNumber(): string
    {
        return $this->getRegistrationPrefix() . $this->getRegistrationNo();
    }

    public function getRegistrationPrefix(): mixed
    {
        return self::getCircularSetting()->registration_prefix;
    }

    public function getRegistrationNo(): string
    {
        $registrationData = Registration::get();

        if ($registrationData->isNotEmpty()) {
            $number = $registrationData->max('registration_no') + 1;
        } else {
            $number = self::getCircularSetting()->registration_number;
        }

        return Str::padLeft($number, 4, 0);
    }
}

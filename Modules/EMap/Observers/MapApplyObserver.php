<?php

namespace Modules\EMap\Observers;

use App\Models\Settings\OfficeSetting;
use Illuminate\Support\Str;
use Modules\EMap\Entities\MapApply;

class MapApplyObserver
{
    public function creating(MapApply $mapApply): void
    {
        $fiscal_year = OfficeSetting::first()->fiscal_year_id ?? null;
        $mapApply->fiscal_year_id = $fiscal_year;
        $mapApply->unique_id = time();
        $mapApply->uuid = Str::uuid();
        /*$mapApply->registration_date = now();
        $mapApply->registration_no = MapApply::where('fiscal_year_id', $fiscal_year)->max('registration_no') + 1;*/
    }
}

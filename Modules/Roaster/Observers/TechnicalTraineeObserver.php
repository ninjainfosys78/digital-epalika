<?php

namespace Modules\Roaster\Observers;

use App\Models\Settings\OfficeSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Roaster\Entities\TechnicalTrainee;

class TechnicalTraineeObserver
{
    /**
     * @throws \Exception
     */
    public function creating(TechnicalTrainee $technicalTrainee)
    {
        $setting = OfficeSetting::with('fiscalYear')->first()->fiscalYear->title;

        checkAgain:

        $randomNumber = random_int(1, 99999);
        $referenceNumber = $setting.'-T-'.Str::padLeft($randomNumber, 5, 0);

        if (DB::table('technical_trainees')
                ->select('reference_id')
                ->where('reference_id', $referenceNumber)
                ->count() > 0) {
            goto checkAgain;
        }

        $technicalTrainee->reference_id = $referenceNumber;
    }
}

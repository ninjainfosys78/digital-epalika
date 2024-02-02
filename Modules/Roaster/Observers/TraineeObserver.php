<?php

namespace Modules\Roaster\Observers;

use App\Models\Settings\OfficeSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Roaster\Entities\Trainee;

class TraineeObserver
{
    /**
     * @throws \Exception
     */
    public function creating(Trainee $trainee)
    {
        $setting = OfficeSetting::with('fiscalYear')->first()->fiscalYear->title;

        checkAgain:

        $randomNumber = random_int(1, 99999);
        $referenceNumber = $setting.'-T-'.Str::padLeft($randomNumber, 5, 0);

        if (DB::table('trainees')
                ->select('reference_id')
                ->where('reference_id', $referenceNumber)
                ->count() > 0) {
            goto checkAgain;
        }

        $trainee->reference_id = $referenceNumber;
    }
}

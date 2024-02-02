<?php

namespace Modules\Recommendation\Observers;

use Modules\Recommendation\Entities\PersonalDetail;

class PersonalDetailObserver
{
    public function creating(PersonalDetail $personalDetail): void
    {
        $personalDetail->reg_no = 'R'.'-' .rand(0, 999) . '-'.officeSetting()->fiscalYear->title ?? '';
        $personalDetail->user_id = auth()->id();
    }
}

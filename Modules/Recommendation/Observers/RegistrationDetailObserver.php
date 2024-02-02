<?php

namespace Modules\Recommendation\Observers;

use Modules\Recommendation\Entities\RegistrationDetail;

class RegistrationDetailObserver
{
    public function creating(RegistrationDetail $registrationDetail): void
    {
        $registrationDetail->registration_no = 'RD'.'-' .rand(0, 999) . '-'.officeSetting()->fiscalYear->title ?? '';
        $registrationDetail->user_id = auth()->id();
    }
}

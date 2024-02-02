<?php

namespace Modules\Circular\Observers;

use Modules\Circular\Entities\Registration;

class RegistrationObserver
{
    public function creating(Registration $registration): void
    {
    }
}

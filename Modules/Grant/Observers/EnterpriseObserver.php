<?php

namespace Modules\Grant\Observers;

use Modules\Grant\Entities\Enterprise;
use Modules\Grant\Traits\UniqueIdTrait;

class EnterpriseObserver
{
    use UniqueIdTrait;

    public function created(Enterprise $enterprise)
    {
        //
    }

    public function creating(Enterprise $enterprise)
    {
        $enterprise->user_id = auth()->id();
        $enterprise->unique_id = $this->generateUniqueId($enterprise, 'enterprises', 'EN');
    }

    public function updated(Enterprise $enterprise)
    {
        //
    }

    public function updating(Enterprise $enterprise)
    {
        //
    }

    public function deleted(Enterprise $enterprise)
    {
        //
    }

    public function restored(Enterprise $enterprise)
    {
        //
    }

    public function forceDeleted(Enterprise $enterprise)
    {
        //
    }
}

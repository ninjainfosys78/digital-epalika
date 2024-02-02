<?php

namespace Modules\Grant\Observers;

use Modules\Grant\Entities\Cooperative;
use Modules\Grant\Traits\UniqueIdTrait;

class CooperativeObserver
{
    use UniqueIdTrait;
    public function created(Cooperative $cooperative)
    {
        //
    }

    public function creating(Cooperative $cooperative): void
    {
        $cooperative->user_id = auth()->id();
        $cooperative->unique_id = $this->generateUniqueId($cooperative, 'cooperatives', 'CR');
    }

    public function updated(Cooperative $cooperative)
    {
        //
    }

    public function updating(Cooperative $cooperative)
    {
        //
    }

    public function deleted(Cooperative $cooperative)
    {
        //
    }

    public function restored(Cooperative $cooperative)
    {
        //
    }

    public function forceDeleted(Cooperative $cooperative)
    {
        //
    }
}

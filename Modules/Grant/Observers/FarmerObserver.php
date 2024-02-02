<?php

namespace Modules\Grant\Observers;

use Modules\Grant\Entities\Farmer;
use Modules\Grant\Traits\UniqueIdTrait;

class FarmerObserver
{
    use UniqueIdTrait;

    public function created(Farmer $farmer)
    {
        //
    }

    public function creating(Farmer $farmer)
    {
        $farmer->user_id = auth()->id();
        $farmer->unique_id = $this->generateUniqueId($farmer, 'farmers', 'FM');
    }

    public function updated(Farmer $farmer)
    {
        //
    }

    public function updating(Farmer $farmer)
    {
        //
    }

    public function deleted(Farmer $farmer)
    {
        //
    }

    public function restored(Farmer $farmer)
    {
        //
    }

    public function forceDeleted(Farmer $farmer)
    {
        //
    }
}

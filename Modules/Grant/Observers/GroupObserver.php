<?php

namespace Modules\Grant\Observers;

use Modules\Grant\Entities\Group;
use Modules\Grant\Traits\UniqueIdTrait;

class GroupObserver
{
    use UniqueIdTrait;

    public function created(Group $group)
    {
        //
    }

    public function creating(Group $group)
    {
        $group->user_id = auth()->id();
        $group->unique_id = $this->generateUniqueId($group, 'groups', 'GR');
    }

    public function updated(Group $group)
    {
        //
    }

    public function updating(Group $group)
    {
        //
    }

    public function deleted(Group $group)
    {
        //
    }

    public function restored(Group $group)
    {
        //
    }

    public function forceDeleted(Group $group)
    {
        //
    }
}

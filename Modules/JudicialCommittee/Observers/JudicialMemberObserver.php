<?php

namespace Modules\JudicialCommittee\Observers;

use Modules\JudicialCommittee\Entities\JudicialMember;

class JudicialMemberObserver
{
    public function creating(JudicialMember $judicialMember)
    {
        if (is_null($judicialMember->position)) {
            $judicialMember->position = JudicialMember::max('position') + 1;

            return;
        }

        $lowerPriorityJudicialMembers = JudicialMember::where('position', '>=', $judicialMember->position)
            ->get();

        foreach ($lowerPriorityJudicialMembers as $lowerPriorityJudicialMember) {
            $lowerPriorityJudicialMember->position++;
            $lowerPriorityJudicialMember->saveQuietly();
        }
    }

    public function updating(JudicialMember $judicialMember)
    {
        if ($judicialMember->isClean('position')) {
            return;
        }

        if (is_null($judicialMember->position)) {
            $judicialMember->position = JudicialMember::max('position');
        }

        if ($judicialMember->getOriginal('position') > $judicialMember->position) {
            $positionRange = [
                $judicialMember->position, $judicialMember->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $judicialMember->getOriginal('position'), $judicialMember->position,
            ];
        }

        $lowerPriorityJudicialMembers = JudicialMember::whereBetween('position', $positionRange)
            ->where('id', '!=', $judicialMember->id)
            ->get();

        foreach ($lowerPriorityJudicialMembers as $lowerPriorityJudicialMember) {
            if ($judicialMember->getOriginal('position') < $judicialMember->position) {
                $lowerPriorityJudicialMember->position--;
            } else {
                $lowerPriorityJudicialMember->position++;
            }
            $lowerPriorityJudicialMember->saveQuietly();
        }
    }

    public function deleting(JudicialMember $judicialMember)
    {
        $lowerPriorityJudicialMembers = JudicialMember::where('position', '>', $judicialMember->position)
            ->get();

        foreach ($lowerPriorityJudicialMembers as $lowerPriorityJudicialMember) {
            $lowerPriorityJudicialMember->position--;
            $lowerPriorityJudicialMember->saveQuietly();
        }
    }
}

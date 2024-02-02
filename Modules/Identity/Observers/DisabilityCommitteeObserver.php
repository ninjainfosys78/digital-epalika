<?php

namespace Modules\Identity\Observers;

use Modules\Identity\Entities\DisabilityCommittee;

class DisabilityCommitteeObserver
{
    public function creating(DisabilityCommittee $disabilityCommittee)
    {
        if (is_null($disabilityCommittee->position)) {
            $disabilityCommittee->position = DisabilityCommittee::max('position') + 1;

            return;
        }

        $lowerPriorityDisabilityCommittees = DisabilityCommittee::where('position', '>=', $disabilityCommittee->position)
            ->get();

        foreach ($lowerPriorityDisabilityCommittees as $lowerPriorityDisabilityCommittee) {
            $lowerPriorityDisabilityCommittee->position++;
            $lowerPriorityDisabilityCommittee->saveQuietly();
        }
    }

    public function updating(DisabilityCommittee $disabilityCommittee)
    {
        if ($disabilityCommittee->isClean('position')) {
            return;
        }

        if (is_null($disabilityCommittee->position)) {
            $disabilityCommittee->position = DisabilityCommittee::max('position');
        }

        if ($disabilityCommittee->getOriginal('position') > $disabilityCommittee->position) {
            $positionRange = [
                $disabilityCommittee->position, $disabilityCommittee->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $disabilityCommittee->getOriginal('position'), $disabilityCommittee->position,
            ];
        }

        $lowerPriorityDisabilityCommittees = DisabilityCommittee::whereBetween('position', $positionRange)
            ->where('id', '!=', $disabilityCommittee->id)
            ->get();

        foreach ($lowerPriorityDisabilityCommittees as $lowerPriorityDisabilityCommittee) {
            if ($disabilityCommittee->getOriginal('position') < $disabilityCommittee->position) {
                $lowerPriorityDisabilityCommittee->position--;
            } else {
                $lowerPriorityDisabilityCommittee->position++;
            }
            $lowerPriorityDisabilityCommittee->saveQuietly();
        }
    }

    public function deleting(DisabilityCommittee $disabilityCommittee)
    {
        $lowerPriorityDisabilityCommittees = DisabilityCommittee::where('position', '>', $disabilityCommittee->position)
            ->get();

        foreach ($lowerPriorityDisabilityCommittees as $lowerPriorityDisabilityCommittee) {
            $lowerPriorityDisabilityCommittee->position--;
            $lowerPriorityDisabilityCommittee->saveQuietly();
        }
    }
}

<?php

namespace Modules\Identity\Observers;

use Modules\Identity\Entities\GovernmentalDisabilityType;

class GovernmentalTypeObserver
{
    public function creating(GovernmentalDisabilityType $governmentalDisabilityType)
    {
        if (is_null($governmentalDisabilityType->position)) {
            $governmentalDisabilityType->position = GovernmentalDisabilityType::max('position') + 1;

            return;
        }

        $lowerPriorityGovernmentalDisabilityTypes = GovernmentalDisabilityType::where('position', '>=', $governmentalDisabilityType->position)
            ->get();

        foreach ($lowerPriorityGovernmentalDisabilityTypes as $lowerPriorityGovernmentalDisabilityType) {
            $lowerPriorityGovernmentalDisabilityType->position++;
            $lowerPriorityGovernmentalDisabilityType->saveQuietly();
        }
    }

    public function updating(GovernmentalDisabilityType $governmentalDisabilityType)
    {
        if ($governmentalDisabilityType->isClean('position')) {
            return;
        }

        if (is_null($governmentalDisabilityType->position)) {
            $governmentalDisabilityType->position = GovernmentalDisabilityType::max('position');
        }

        if ($governmentalDisabilityType->getOriginal('position') > $governmentalDisabilityType->position) {
            $positionRange = [
                $governmentalDisabilityType->position, $governmentalDisabilityType->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $governmentalDisabilityType->getOriginal('position'), $governmentalDisabilityType->position,
            ];
        }

        $lowerPriorityGovernmentalDisabilityTypes = GovernmentalDisabilityType::whereBetween('position', $positionRange)
            ->where('id', '!=', $governmentalDisabilityType->id)
            ->get();

        foreach ($lowerPriorityGovernmentalDisabilityTypes as $lowerPriorityGovernmentalDisabilityType) {
            if ($governmentalDisabilityType->getOriginal('position') < $governmentalDisabilityType->position) {
                $lowerPriorityGovernmentalDisabilityType->position--;
            } else {
                $lowerPriorityGovernmentalDisabilityType->position++;
            }
            $lowerPriorityGovernmentalDisabilityType->saveQuietly();
        }
    }

    public function deleting(GovernmentalDisabilityType $governmentalDisabilityType)
    {
        $lowerPriorityGovernmentalDisabilityTypes = GovernmentalDisabilityType::where('position', '>', $governmentalDisabilityType->position)
            ->get();

        foreach ($lowerPriorityGovernmentalDisabilityTypes as $lowerPriorityGovernmentalDisabilityType) {
            $lowerPriorityGovernmentalDisabilityType->position--;
            $lowerPriorityGovernmentalDisabilityType->saveQuietly();
        }
    }
}

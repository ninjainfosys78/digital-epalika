<?php

namespace App\Observers;

use App\Models\Settings\Units\Unit;

class UnitObserver
{
    public function creating(Unit $unit)
    {
        if ($unit->is_smallest == 1) {
            Unit::where('measurement_unit_id', $unit->measurement_unit_id)->update(['is_smallest' => 0]);
        }
        if (is_null($unit->position)) {
            $unit->position = Unit::where('measurement_unit_id', $unit->measurement_unit_id)->max('position') + 1;

            return;
        }

        $lowerPriorityUnits = Unit::where('measurement_unit_id', $unit->measurement_unit_id)
            ->where('position', '>=', $unit->position)
            ->get();

        foreach ($lowerPriorityUnits as $lowerPriorityUnit) {
            $lowerPriorityUnit->position++;
            $lowerPriorityUnit->saveQuietly();
        }
    }

    public function updating(Unit $unit)
    {
        if (!$unit->isClean('is_smallest') && $unit->is_smallest == 1) {
            Unit::where('measurement_unit_id', $unit->measurement_unit_id)->update(['is_smallest' => 0]);
        }

        if ($unit->isClean('position')) {
            return;
        }

        if (is_null($unit->position)) {
            $unit->position = Unit::where('measurement_unit_id', $unit->measurement_unit_id)->max('position');
        }

        if ($unit->getOriginal('position') > $unit->position) {
            $positionRange = [
                $unit->position, $unit->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $unit->getOriginal('position'), $unit->position,
            ];
        }

        $lowerPrioritySubUnits = Unit::where('measurement_unit_id', $unit->measurement_unit_id)
            ->whereBetween('position', $positionRange)
            ->where('id', '!=', $unit->id)
            ->get();

        foreach ($lowerPrioritySubUnits as $lowerPrioritySubUnit) {
            if ($unit->getOriginal('position') < $unit->position) {
                $lowerPrioritySubUnit->position--;
            } else {
                $lowerPrioritySubUnit->position++;
            }
            $lowerPrioritySubUnit->saveQuietly();
        }
    }

    public function deleted(Unit $unit)
    {
        $lowerPriorityUnits = Unit::where('measurement_unit_id', $unit->measurement_unit_id)
            ->where('position', '>', $unit->position)
            ->get();

        foreach ($lowerPriorityUnits as $lowerPriorityUnit) {
            $lowerPriorityUnit->position--;
            $lowerPriorityUnit->saveQuietly();
        }
    }
}

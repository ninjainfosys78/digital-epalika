<?php

namespace App\Observers;

use App\Models\Website\MunicipalDetail;

class MunicipalDetailObserver
{
    public function creating(MunicipalDetail $municipalDetail)
    {
        if (is_null($municipalDetail->position)) {
            $municipalDetail->position = MunicipalDetail::max('position') + 1;

            return;
        }

        $lowerPriorityMunicipalDetails = MunicipalDetail::where('position', '>=', $municipalDetail->position)
            ->get();

        foreach ($lowerPriorityMunicipalDetails as $lowerPriorityMunicipalDetail) {
            $lowerPriorityMunicipalDetail->position++;
            $lowerPriorityMunicipalDetail->saveQuietly();
        }
    }

    public function updating(MunicipalDetail $municipalDetail)
    {
        if ($municipalDetail->isClean('position')) {
            return;
        }

        if (is_null($municipalDetail->position)) {
            $municipalDetail->position = MunicipalDetail::max('position');
        }

        if ($municipalDetail->getOriginal('position') > $municipalDetail->position) {
            $positionRange = [
                $municipalDetail->position, $municipalDetail->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $municipalDetail->getOriginal('position'), $municipalDetail->position,
            ];
        }

        $lowerPriorityMunicipalDetails = MunicipalDetail::whereBetween('position', $positionRange)
            ->where('id', '!=', $municipalDetail->id)
            ->get();

        foreach ($lowerPriorityMunicipalDetails as $lowerPriorityMunicipalDetail) {
            if ($municipalDetail->getOriginal('position') < $municipalDetail->position) {
                $lowerPriorityMunicipalDetail->position--;
            } else {
                $lowerPriorityMunicipalDetail->position++;
            }
            $lowerPriorityMunicipalDetail->saveQuietly();
        }
    }

    public function deleting(MunicipalDetail $municipalDetail)
    {
        $lowerPriorityMunicipalDetails = MunicipalDetail::where('position', '>', $municipalDetail->position)
            ->get();

        foreach ($lowerPriorityMunicipalDetails as $lowerPriorityMunicipalDetail) {
            $lowerPriorityMunicipalDetail->position--;
            $lowerPriorityMunicipalDetail->saveQuietly();
        }
    }
}

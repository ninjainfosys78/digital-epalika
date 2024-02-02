<?php

namespace App\Observers;

use App\Models\OfficeHeader;

class OfficeHeaderObserver
{
    public function creating(OfficeHeader $officeHeader)
    {
        if (is_null($officeHeader->position)) {
            $officeHeader->position = OfficeHeader::max('position') + 1;

            return;
        }

        $lowerPriorityOfficeHeaders = OfficeHeader::where('position', '>=', $officeHeader->position)
            ->get();

        foreach ($lowerPriorityOfficeHeaders as $lowerPriorityOfficeHeader) {
            $lowerPriorityOfficeHeader->position++;
            $lowerPriorityOfficeHeader->saveQuietly();
        }
    }

    public function updating(OfficeHeader $officeHeader)
    {
        if ($officeHeader->isClean('position')) {
            return;
        }

        if (is_null($officeHeader->position)) {
            $officeHeader->position = OfficeHeader::max('position');
        }

        if ($officeHeader->getOriginal('position') > $officeHeader->position) {
            $positionRange = [
                $officeHeader->position, $officeHeader->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $officeHeader->getOriginal('position'), $officeHeader->position,
            ];
        }

        $lowerPriorityOfficeHeaders = OfficeHeader::whereBetween('position', $positionRange)
            ->where('id', '!=', $officeHeader->id)
            ->get();

        foreach ($lowerPriorityOfficeHeaders as $lowerPriorityOfficeHeader) {
            if ($officeHeader->getOriginal('position') < $officeHeader->position) {
                $lowerPriorityOfficeHeader->position--;
            } else {
                $lowerPriorityOfficeHeader->position++;
            }
            $lowerPriorityOfficeHeader->saveQuietly();
        }
    }

    public function deleting(OfficeHeader $officeHeader)
    {
        $lowerPriorityOfficeHeaders = OfficeHeader::where('position', '>', $officeHeader->position)
            ->get();

        foreach ($lowerPriorityOfficeHeaders as $lowerPriorityOfficeHeader) {
            $lowerPriorityOfficeHeader->position--;
            $lowerPriorityOfficeHeader->saveQuietly();
        }
    }
}

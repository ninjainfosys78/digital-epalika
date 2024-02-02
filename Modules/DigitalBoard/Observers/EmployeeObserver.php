<?php

namespace Modules\DigitalBoard\Observers;

use App\Models\Settings\Employee;

class EmployeeObserver
{
    public function creating(Employee $employee)
    {
        if (is_null($employee->position)) {
            $employee->position = Employee::max('position') + 1;

            return;
        }

        $lowerPriorityEmployees = Employee::where('position', '>=', $employee->position)
            ->get();

        foreach ($lowerPriorityEmployees as $lowerPriorityEmployee) {
            $lowerPriorityEmployee->position++;
            $lowerPriorityEmployee->saveQuietly();
        }
    }

    public function updating(Employee $employee)
    {
        if ($employee->isClean('position')) {
            return;
        }

        if (is_null($employee->position)) {
            $employee->position = Employee::max('position');
        }

        if ($employee->getOriginal('position') > $employee->position) {
            $positionRange = [
                $employee->position, $employee->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $employee->getOriginal('position'), $employee->position,
            ];
        }

        $lowerPriorityEmployees = Employee::whereBetween('position', $positionRange)
            ->where('id', '!=', $employee->id)
            ->get();

        foreach ($lowerPriorityEmployees as $lowerPriorityEmployee) {
            if ($employee->getOriginal('position') < $employee->position) {
                $lowerPriorityEmployee->position--;
            } else {
                $lowerPriorityEmployee->position++;
            }
            $lowerPriorityEmployee->saveQuietly();
        }
    }

    public function deleting(Employee $employee)
    {
        $lowerPriorityEmployees = Employee::where('position', '>', $employee->position)
            ->get();

        foreach ($lowerPriorityEmployees as $lowerPriorityEmployee) {
            $lowerPriorityEmployee->position--;
            $lowerPriorityEmployee->saveQuietly();
        }
    }
}

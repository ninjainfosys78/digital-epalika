<?php

namespace App\View\Components\Frontend;

use App\Models\Settings\Employee;
use Illuminate\View\Component;

class EmployeeSectionComponent extends Component
{
    public $employees;

    public function __construct()
    {
        $this->employees = Employee::orderBy('position')->get();
    }

    public function render()
    {
        return view('components.frontend.employee-section-component');
    }
}

<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminTraineeTable extends Component
{
    public $trainees = [];
    public $training;

    public function __construct($trainees = null, $training = null)
    {
        $this->trainees = $trainees;
        $this->training = $training;
    }

    public function render()
    {
        return view('components.admin-trainee-table');
    }
}

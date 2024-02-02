<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TechnicalTraineeTable extends Component
{
    public $trainees = [];

    public function __construct($trainees = null)
    {
        $this->trainees = $trainees;
    }

    public function render()
    {
        return view('components.technical-trainee-table');
    }
}

<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TrainingTableComponent extends Component
{
    public $trainings = [];

    public function __construct($trainingData = null)
    {
        $this->trainings = $trainingData;
    }

    public function render()
    {
        return view('components.training-table-component');
    }
}

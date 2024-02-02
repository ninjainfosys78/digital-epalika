<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MapApplyComponent extends Component
{
    public $maps = [];
    public $application;

    public function __construct($maps = null, $application = null)
    {
        $this->maps = $maps;
        $this->application = $application;
    }

    public function render()
    {
        return view('components.map-apply-component');
    }
}

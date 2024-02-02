<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ApproveFormComponent extends Component
{
    public $formDataType;
    public $mapApply;
    public $form;
    public function __construct($form,$formDataType,$mapApply)
    {
        $this->form = $form;
        $this->formDataType = $formDataType;
        $this->mapApply = $mapApply;
    }


    public function render()
    {
        return view('components.approve-form-component');
    }
}

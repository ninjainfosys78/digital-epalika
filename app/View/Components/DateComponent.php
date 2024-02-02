<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DateComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $name_ne;
    public $label_ne;
    public $name_en;
    public $label_en;

    public function __construct($data)
    {
        $this->name_ne = array_key_exists('name_ne', $data) ? $data['name_ne'] : '';
        $this->label_ne = array_key_exists('label_ne', $data) ? $data['label_ne'] : '';
        $this->name_en = array_key_exists('name_en', $data) ? $data['name_en'] : '';
        $this->label_en = array_key_exists('label_en', $data) ? $data['label_en'] : '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.date-component');
    }
}

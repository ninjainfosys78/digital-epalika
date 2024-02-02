<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdToBs extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $adDate;

    public $id;

    public function __construct($id, $adDate)
    {
        $this->adDate = $adDate ?? today();

        $this->id = $id ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ad-to-bs');
    }
}

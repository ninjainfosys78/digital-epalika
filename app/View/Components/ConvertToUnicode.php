<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ConvertToUnicode extends Component
{
    public function __construct(public string $number = '', public string $id = '')
    {
        //
    }

    public function render()
    {
        return view('components.convert-to-unicode');
    }
}

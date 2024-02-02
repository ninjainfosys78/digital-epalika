<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NumberIntoUnicode extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public string $id, public string $number, public string $class = '', public bool $isCurrency = true)
    {
        //
    }

    public function render(): View|Factory|Htmlable|\Closure|string|Application
    {
        return view('components.number-into-unicode');
    }
}

<?php

namespace App\View\Components;

use App\Models\OfficeHeader;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class LetterHeadComponent extends Component
{
    public Collection $officeHeaders;
    public function __construct()
    {
        $this->officeHeaders = OfficeHeader::orderBy('position')->get();
    }

    public function render()
    {
        return view('components.letter-head-component');
    }
}

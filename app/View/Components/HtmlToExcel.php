<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HtmlToExcel extends Component
{
    public function __construct(public $fileName, public $targetTable, public $fileType = 'xlsx')
    {
        //
    }

    public function render()
    {
        return view('components.html-to-excel');
    }
}

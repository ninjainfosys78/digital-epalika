<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportExport implements FromView, ShouldAutoSize
{
    public function __construct(public $lists = [])
    {
    }
    public function view(): View
    {
        return view('report.table', [
            'lists' => $this->lists,
            'excelUrl' => null
        ]);
    }
}

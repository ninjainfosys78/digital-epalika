<?php

namespace App\View\Components\AmChart;

use Illuminate\View\Component;

class PieChartComponent extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('components.am-chart.pie-chart-component');
    }
}

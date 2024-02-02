<?php

namespace App\View\Components\Charts;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BarChartComponent extends Component
{
    public function __construct(
        public array $labels,
        public array $dataSets,
        public string $chartTitle,
        public string $chartType = 'bar',
        public string $id = 'myChart',
        public bool $displayLegend = true
    ) {
    }

    public function render(): View|Factory|Htmlable|Closure|string|Application
    {
        return view('components.charts.bar-chart-component');
    }
}

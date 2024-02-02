<?php

namespace App\View\Components\Charts;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PieChartComponent extends Component
{
    public function __construct(
        public array $labels = [],
        public array $dataSets = [],
        public string $id = 'pie-chart',
        public string $chartName = 'pie-chart',
        public string $chartType = 'pie',
        public bool $displayLegend = true
    ) {
    }

    public function render(): View|Factory|Htmlable|string|Closure|Application
    {
        return view('components.charts.pie-chart-component');
    }
}

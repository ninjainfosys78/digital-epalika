<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DateInputComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string  $nameNe = 'date',
        public string  $labelNe = 'मिति',
        public string  $nameEn = 'date_en',
        public string  $labelEn = 'Date',
        public bool    $showEnglishDate = false,
        public bool    $getTodayDate = true,
        public ?string $idNe = null,
        public ?string $idEn = null,
        public ?string $editDateNe = null,
        public ?string $editDateEn = null,
        public ?string $container = null,
        public ?string $disableBeforeAd = null,
        public ?string $disableAfterAd = null,
        public ?string $disableBefore = null,
        public ?string $disableAfter = null
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('components.date-input-component');
    }
}

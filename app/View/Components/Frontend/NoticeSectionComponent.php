<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;
use Modules\DigitalBoard\Entities\Service;

class NoticeSectionComponent extends Component
{
    public $services;

    public function __construct()
    {
        $this->services = Service::with('serviceDocuments')->get() ?? [];
    }

    public function render()
    {
        return view('components.frontend.notice-section-component');
    }
}

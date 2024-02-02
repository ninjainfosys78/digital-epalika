<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;
use Modules\DigitalBoard\Entities\Video;

class DigitalBoardVideoComponent extends Component
{
    public $videos;

    public function __construct()
    {
        $this->videos = Video::latest()->get();
    }

    public function render()
    {
        return view('components.frontend.digital-board-video-component');
    }
}

<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;
use Modules\DigitalBoard\Entities\Notice;

class ScrollNewsComponent extends Component
{
    public $scrollNews;

    public function __construct()
    {
        $this->scrollNews = Notice::where('type', 'News')->whereNull('closed_at')->orderByDesc('date')->limit(5)->get();
    }

    public function render()
    {
        return view('components.frontend.scroll-news-component');
    }
}

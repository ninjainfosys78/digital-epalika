<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Modules\DigitalBoard\Entities\Notice;

class NoticeVerticalSliderComponent extends Component
{
    public $notices;

    public function __construct(int|null $ward = null)
    {
        $this->notices = Notice::with('files')
            ->withCount('files')
            ->showInIndex()
            ->where(function ($q) use ($ward) {
                if (!empty($ward)) {
                   $q->where('ward_no', $ward);
                } else {
                    $q->whereNull('ward_no');
                }
            })
            ->contentType('Notice')
            ->whereNull('closed_at')
            ->orderByDesc('date')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.notice-vertical-slider-component');
    }
}

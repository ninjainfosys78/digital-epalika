<?php

namespace App\View\Components\frontend;

use Illuminate\View\Component;
use Modules\DigitalBoard\Entities\CitizenCharter;

class CitizenCharterComponent extends Component
{
    public $citizenCharters;


    public function __construct(int|null $ward = null)
    {
        $this->citizenCharters = CitizenCharter::with('branch')
            ->where(function ($q) use ($ward) {
                if (!empty($ward)) {
                    $q->where('ward', $ward);
                } else {
                    $q->whereNull('ward');
                }
            })
            ->orderBy('branch_id')
            ->get();
    }


    public function render()
    {
        return view('components.frontend.citizen-charter-component', [
            'citizenCharters' => $this->citizenCharters,
        ]);
    }

}

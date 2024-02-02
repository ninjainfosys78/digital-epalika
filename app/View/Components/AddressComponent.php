<?php

namespace App\View\Components;

use App\Models\Address\Province;
use Illuminate\View\Component;

class AddressComponent extends Component
{
    public $provinces;

    public function __construct(
        public $provinceId = null,
        public $districtId = null,
        public $localBodyId = null,
        public $wardNo = null
    ) {
        $this->provinces = Province::all();
    }

    public function render()
    {
        return view('components.address-component');
    }
}

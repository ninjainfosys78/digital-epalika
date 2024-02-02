<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MobileUserAddress extends Component
{


    public $temporary_province_id = '';

    public $temporary_district_id = '';

    public $temporary_local_body_id = '';

    public $temporary_ward = '';

    public $provinces = [];

    public $districts = [];

    public $localBodies = [];

    public $wards = '';

    public function mount($address = null)
    {
        $this->provinces = get_provinces();

        if (!empty($address)) {

            $this->temporary_province_id = $address['province_id'] ?? '';
            $this->temporary_district_id = $address['district_id'] ?? '';
            $this->temporary_local_body_id = $address['local_body_id'] ?? '';
            $this->temporary_ward = $address['ward_no'] ?? '';
        }
    }

    public function render()
    {

        if (!empty($this->temporary_province_id)) {
            $this->districts = get_districts($this->temporary_province_id);
        }
        if (!empty($this->temporary_district_id)) {
            $this->localBodies = get_local_bodies($this->temporary_district_id);
        }
        if (!empty($this->temporary_local_body_id)) {
            $this->wards = get_local_bodies(localBodyId: $this->temporary_local_body_id)->wards;
        }

        return view('livewire.mobile-user-address');
    }
}

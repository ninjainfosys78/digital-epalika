<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Address extends Component
{
    public $province_id = '';

    public $district_id = '';

    public $local_body_id = '';

    public $ward_no = '';

    public $provinces = [];

    public $districts = [];

    public $localBodies = [];

    public $wards = '';

    public function mount($address = null)
    {
        $this->provinces = get_provinces();

        if (!empty($address)) {
            $this->province_id = $address['province_id'] ?? '';
            $this->district_id = $address['district_id'] ?? '';
            $this->local_body_id = $address['local_body_id'] ?? '';
            $this->ward_no = $address['ward_no'] ?? '';
        }
    }

    public function render()
    {
        if (!empty($this->province_id)) {
            $this->districts = get_districts($this->province_id);
        }
        if (!empty($this->district_id)) {
            $this->localBodies = get_local_bodies($this->district_id);
        }
        if (!empty($this->local_body_id)) {
            $this->wards = get_local_bodies(localBodyId: $this->local_body_id)->wards;
        }

        return view('livewire.address');
    }
}

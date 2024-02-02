<?php

namespace App\Http\Livewire\Setting;

use App\Models\Settings\Units\Type;
use Livewire\Component;

class MeasurementUnit extends Component
{
    public $types = [];

    public $measurementUnits = [];

    public $type_id;

    public $measurement_unit_id;

    public function mount($unit = null)
    {
        $this->types = Type::all();
        if (!empty($unit)) {
            $this->type_id = $unit['type_id'] ?? '';
            $this->measurement_unit_id = $unit['measurement_unit_id'] ?? '';
        }
    }

    public function render()
    {
        if (!empty($this->type_id)) {
            $this->measurementUnits = Type::with('measurementUnit')->find($this->type_id)->measurementUnit;
        }

        return view('livewire.setting.measurement-unit');
    }
}

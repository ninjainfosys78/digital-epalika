<?php

namespace Modules\Plan\Http\Livewire;

use App\Models\Settings\FiscalYear;
use App\Models\Settings\Units\Unit;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\Plan\Entities\CrewRate;
use Modules\Plan\Entities\Equipment;
use Modules\Plan\Entities\EquipmentAdditionalCost;
use Modules\Plan\Entities\Fuel;
use Modules\Plan\Entities\FuelDemand;
use Modules\Plan\Entities\Labour;

class EquipmentFormLivewire extends Component
{
    public $formData;
    public $fiscalYears = [];
    public $equipments = [];
    public $units = [];
    public $fuels = [];
    public $labours = [];
    public $existingForm = null;

    public array $form = [
        'equipment_id' => null,
        'equipmentAdditionalCost' => [],
        'fuelDemand' => [],
        'crewCreate' => [],

    ];

    public function mount($formData = null)
    {
        $this->fiscalYears = FiscalYear::all();
        $this->equipments = Equipment::all();
        $this->units = Unit::all();
        $this->fuels = Fuel::all();
        $this->labours = Labour::all();

        if (!empty($formData)) {

            $this->form['equipment_id'] = $formData->id;

            foreach ($formData->equipmentAdditionalCosts as $index => $equipmentAdditionalCost) {
                $this->form['equipmentAdditionalCost'][] = [
                    'id' => $equipmentAdditionalCost->id ?? null,
                    'rate' => $equipmentAdditionalCost->rate ?? null,
                    'unit_id' => $equipmentAdditionalCost->unit_id ?? null,
                    'fiscal_year_id' => $equipmentAdditionalCost->fiscal_year_id ?? null,
                ];
            }
            foreach ($formData->fuelDemands as $index => $fuelDemand) {
                $this->form['fuelDemand'][] = [
                    'id' => $fuelDemand->id ?? null,
                    'quantity' => $fuelDemand->quantity ?? null,
                    'fuel_id' => $fuelDemand->fuel_id ?? null,
                ];
            }
            foreach ($formData->crewRates as $index => $crewRate) {
                $this->form['crewCreate'][] = [
                    'id' => $crewRate->id ?? null,
                    'quantity' => $crewRate->quantity ?? null,
                    'labour_id' => $crewRate->labour_id ?? null,
                ];
            }
        } else {
            $this->form['equipmentAdditionalCost'] = [[]];
            $this->form['fuelDemand'] = [[]];
            $this->form['crewCreate'] = [[]];
        }
    }



    public function addEquipmentAdditionalCost(): void
    {
        $this->form['equipmentAdditionalCost'][] =   [];
    }

    public function removeEquipmentAdditionalCost($index): void
    {
        if (isset($this->form['equipmentAdditionalCost'][$index])) {
            $formDataType = $this->form['equipmentAdditionalCost'][$index];

            if (isset($formDataType['id'])) {
                $formDataTypeRecord = EquipmentAdditionalCost::find($formDataType['id']);
                if ($formDataTypeRecord) {
                    $formDataTypeRecord->delete();
                }
            }
            $formDataTypeCollection = collect($this->form['equipmentAdditionalCost']);
            $formDataTypeCollection->forget($index);

            $this->form['equipmentAdditionalCost'] = $formDataTypeCollection->values()->all();
        }
    }


    public function addFuelDemand(): void
    {
        $this->form['fuelDemand'][] =   [];
    }

    public function removeFuelDemand($index): void
    {
        if (isset($this->form['fuelDemand'][$index])) {
            $formDataType = $this->form['fuelDemand'][$index];

            if (isset($formDataType['id'])) {
                $formDataTypeRecord = FuelDemand::find($formDataType['id']);
                if ($formDataTypeRecord) {
                    $formDataTypeRecord->delete();
                }
            }
            $formDataTypeCollection = collect($this->form['fuelDemand']);
            $formDataTypeCollection->forget($index);

            $this->form['fuelDemand'] = $formDataTypeCollection->values()->all();
        }
    }

    public function addCrewCreate(): void
    {
        $this->form['crewCreate'][] =   [];
    }

    public function removeCrewCreate($index): void
    {
        if (isset($this->form['crewCreate'][$index])) {
            $formDataType = $this->form['crewCreate'][$index];

            if (isset($formDataType['id'])) {
                $formDataTypeRecord = CrewRate::find($formDataType['id']);
                if ($formDataTypeRecord) {
                    $formDataTypeRecord->delete();
                }
            }
            $formDataTypeCollection = collect($this->form['crewCreate']);
            $formDataTypeCollection->forget($index);

            $this->form['crewCreate'] = $formDataTypeCollection->values()->all();
        }
    }

    protected $rules = [
        "form.equipment_id" => ['required', 'integer', 'exists:equipment,id,deleted_at,NULL'],
        "form.equipmentAdditionalCost" => ['required', 'array'],
        "form.equipmentAdditionalCost.*.rate" => ['required'],
        "form.equipmentAdditionalCost.*.unit_id" => ['required'],
        "form.equipmentAdditionalCost.*.fiscal_year_id" => ['required'],
        "form.fuelDemand" => ['required', 'array'],
        "form.fuelDemand.*.quantity" => ['required'],
        "form.fuelDemand.*.fuel_id" => ['required'],
        "form.crewCreate" => ['required', 'array'],
        "form.crewCreate.*.quantity" => ['required'],
        "form.crewCreate.*.labour_id" => ['required'],
    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validatedData = $this->validate();

        DB::transaction(function () use ($validatedData) {

            if (!empty($this->formData)) {
                $equipment = Equipment::find($validatedData['form']['equipment_id']);

                foreach ($this->form['equipmentAdditionalCost'] as $equipmentAdditionalCost) {
                    if (array_key_exists('id', $equipmentAdditionalCost)) {
                        $EqData = EquipmentAdditionalCost::find($equipmentAdditionalCost['id']);
                        $EqData->update($equipmentAdditionalCost);
                    } else {
                        $EqData = $equipment->equipmentAdditionalCosts()->create($equipmentAdditionalCost);
                    }
                }

                foreach ($this->form['fuelDemand'] as $fuelDemand) {
                    if (array_key_exists('id', $fuelDemand)) {
                        $formDataTypeData = FuelDemand::find($fuelDemand['id']);
                        $formDataTypeData->update($fuelDemand);
                    } else {
                        $formDataTypeData = $equipment->fuelDemands()->create($fuelDemand);
                    }
                }

                foreach ($this->form['crewCreate'] as $crewRate) {
                    if (array_key_exists('id', $crewRate) && !empty($crewRate['id'])) {
                        $formDataTypeDataCrew = CrewRate::find($crewRate['id']);
                        $formDataTypeDataCrew->update($crewRate);
                    } else {
                        $formDataTypeDataCrew = $equipment->crewRates()->create($crewRate);
                    }
                }
            }
        });

        $this->reset('form');
        toast('सफलतापूर्वक थपियो', 'success');
        return redirect(route('admin.plan.equipmentAdditionalCost.index'));
        return back();
    }


    public function render()
    {
        return view('plan::livewire.equipment-form-livewire');
    }
}

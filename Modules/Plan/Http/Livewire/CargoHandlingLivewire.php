<?php

namespace Modules\Plan\Http\Livewire;

use App\Models\Settings\FiscalYear;
use App\Models\Settings\Units\Unit;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\Plan\Entities\CargoHandling;
use Modules\Plan\Entities\CollectionResource;
use Modules\Plan\Entities\Material;

class CargoHandlingLivewire extends Component
{
    public $materialData;

    public $fiscalYears = [];
    public $materials = [];
    public $units = [];
    public array $form = [
        'fiscal_year_id' => null,
        'material_id' => null,
        'unit_id' => null,
        'collectionResources' => [],

    ];
    public $existingForm = null;
    public function mount($materialData = null)
    {


        if (!empty($materialData)) {
            $this->existingForm = $materialData;
            $this->form['fiscal_year_id'] = $materialData->fiscal_year_id;
            $this->form['material_id'] = $materialData->material_id;
            $this->form['unit_id'] = $materialData->unit_id;

            foreach ($materialData->collectionResources as $index => $formDataType) {
                $this->form['collectionResources'][] = [
                    'id' => $formDataType->id ?? null,
                    'collectable' => $formDataType->collectable ?? null,
                    'type' => $formDataType->type ?? null,
                    'quantity' => $formDataType->quantity ?? null,
                    'rate_type' => $formDataType->rate_type ?? null,
                    'rate' => $formDataType->rate ?? null,
                ];
            }
        } else {
            $this->form['collectionResources'] = [[]];
        }

        $this->fiscalYears = FiscalYear::all();
        $this->materials = Material::all();
        $this->units = Unit::all();
    }

    public function addData(): void
    {
        $this->form['collectionResources'][] =   [];
    }

    public function removeData($index): void
    {
        if (isset($this->form['collectionResources'][$index])) {
            $formDataType = $this->form['collectionResources'][$index];

            if (isset($formDataType['id'])) {
                $formDataTypeRecord = CollectionResource::find($formDataType['id']);
                if ($formDataTypeRecord) {
                    $formDataTypeRecord->delete();
                }
            }
            $formDataTypeCollection = collect($this->form['collectionResources']);
            $formDataTypeCollection->forget($index);

            $this->form['collectionResources'] = $formDataTypeCollection->values()->all();
        }
    }

    protected $rules = [
        "form.fiscal_year_id" => ['required', 'integer', 'exists:fiscal_years,id,deleted_at,NULL'],
        "form.material_id" => ['required', 'integer', 'exists:materials,id,deleted_at,NULL'],
        "form.unit_id" => ['required', 'integer', 'exists:units,id,deleted_at,NULL'],
        "form.collectionResources" => ['required', 'array'],
        "form.collectionResources.*.collectable" => ['required'],
        "form.collectionResources.*.type" => ['required'],
        "form.collectionResources.*.quantity" => ['required'],
        "form.collectionResources.*.rate_type" => ['required'],
        "form.collectionResources.*.rate" => ['required'],

    ];


    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validatedData = $this->validate();
        DB::transaction(function () use ($validatedData) {
            if (!empty($this->existingForm)) {
                $this->existingForm->update($validatedData['form']);
                $form = $this->existingForm;
                foreach ($this->form['collectionResources'] as $formDataType) {
                    if (array_key_exists('id', $formDataType)) {
                        $formDataTypeData = CollectionResource::find($formDataType['id']);
                        $formDataTypeData->update($formDataType);
                    } else {
                        $formDataTypeData = $form->collectionResources()->create($formDataType);
                    }
                }
            } else {
                $form = CargoHandling::create($validatedData['form']);
                foreach ($this->form['collectionResources'] as $formDataType) {
                    $formDataTypeData = $form->collectionResources()->create($formDataType);
                }
            }
        });

        $this->reset('form');
        toast('सफलतापूर्वक थपियो', 'success');
        return redirect(route('admin.plan.cargoHandling.index'));
    }
    public function render()
    {
        return view('plan::livewire.cargo-handling-livewire');
    }
}

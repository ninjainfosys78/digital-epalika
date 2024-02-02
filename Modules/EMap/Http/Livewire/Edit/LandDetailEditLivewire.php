<?php

namespace Modules\EMap\Http\Livewire\Edit;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\EMap\Entities\LandUseArea;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Entities\MapSetting;

class LandDetailEditLivewire extends Component
{
    public MapApply $mapApply;

    public $conversion_units;

    public bool $editForm = false;

    public array $landDescription = [
        'land_use_area_id' => null,
        'ward_no' => null,
        'former_ward_no' => null,
        'tole' => null,
        'street_code_no' => null,
        'plot_no' => null,
        'unit_value' => 0,
        'percentage_of_area_covered_by_building' => null,
    ];


    public $landUseAreas = [];

    public function mount(MapApply $mapApply)
    {
        $this->mapApply = $mapApply;
        $this->landUseAreas = LandUseArea::get();

        $this->landDescription = [
            'land_use_area_id' => $mapApply->landDetail->land_use_area_id ?? null,
            'ward_no' => $mapApply->landDetail->ward_no ?? null,
            'former_ward_no' => $mapApply->landDetail->former_ward_no ?? null,
            'tole' => $mapApply->landDetail->tole ?? null,
            'street_code_no' => $mapApply->landDetail->street_code_no ?? null,
            'plot_no' => $mapApply->landDetail->plot_no ?? null,
            'unit_value' => $mapApply->landDetail->unit_value ?? 0,
            'percentage_of_area_covered_by_building' => $mapApply->landDetail->percentage_of_area_covered_by_building ?? null,
        ];
    }

    public function setEditForm(): void
    {
        $this->editForm = !$this->editForm;
    }

    protected array $landDescriptionValidations = [
        'landDescription.land_use_area_id' => ['required', 'numeric'],
        'landDescription.ward_no' => ['required', 'integer'],
        'landDescription.former_ward_no' => ['required', 'integer'],
        'landDescription.tole' => ['nullable'],
        'landDescription.street_code_no' => ['nullable'],
        'landDescription.plot_no' => ['required'],
        'landDescription.unit_value' => ['nullable'],
        'landDescription.percentage_of_area_covered_by_building' => ['required', 'numeric'],
    ];

    public function rules(): array
    {
        return $this->landDescriptionValidations;
    }

    public function saveFormData(): void
    {
        if ($this->editForm) {
            $this->validate();
            DB::transaction(function () {
                $this->mapApply->landDetail()->update($this->landDescription + [
                    'unit_id' => MapSetting::first()->land_measurement_standard_id ?? null,
                ]);
            });

            $this->reset('editForm');

            $this->dispatchBrowserEvent('alert_message', [
                'type' => 'success',
                'title' => 'धन्यबाद',
                'text' => 'तपाईको फारम सफलतापूर्वक दर्ता भयो',
            ]);
        }
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function messages(): array
    {
        return [
            'landDescription.land_use_area_id.required' => 'भू-उपयोग्य क्षेत्र अनिवार्य छ|',
            'landDescription.land_use_area_id.numeric' => 'भू-उपयोग्य क्षेत्र नम्बरमा हुनुपर्छ|',
            'landDescription.ward_no.required' => 'वडा नं अनिवार्य छ|',
            'landDescription.ward_no.integer' => 'वडा नं नम्बरमा हुनुपर्छ|',
            'landDescription.former_ward_no.required' => ' साविक वडा नं अनिवार्य छ|',
            'landDescription.former_ward_no.integer' => ' साविक वडा नं नम्बरमा हुनुपर्छ|',
            'landDescription.plot_no.required' => 'कित्ता नं अनिवार्य छ|',
            'landDescription.percentage_of_area_covered_by_building.required' => ' क्षेत्रफलको प्रतिशत अनिवार्य छ|',
            'landDescription.percentage_of_area_covered_by_building.numeric' => 'क्षेत्रफलको प्रतिशत नम्बरमा हुनुपर्छ|',
        ];
    }

    public function render()
    {
        return view('emap::livewire.edit.land-detail-edit-livewire');
    }
}

<?php

namespace Modules\EMap\Http\Livewire\Edit;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Entities\StructureType;

class MapApplyEditLivewire extends Component
{
    public MapApply $mapApply;

    public array $applyMap = [
        'construction_type' => null,
        'usage' => null,
        'building_category' => null,
        'structure_type_id' => null,
        'structure_type' => null,
        'current_storey' => null,
        'area_of_plinth' => null,
        'future_storey' => null,
        'length' => null,
        'breadth' => null,
        'height' => null,
    ];

    public bool $editForm = false;

    public $open_structure_type = 0;

    public $structureTypes;

    public $allDistricts;

    public function setEditForm(): void
    {
        $this->editForm = !$this->editForm;
    }

    public function mount(MapApply $mapApply, $districts): void
    {
        $this->mapApply = $mapApply;

        $this->applyMap = [
            'construction_type' => $mapApply->construction_type->value,
            'usage' => $mapApply->usage ?? null,
            'building_category' => $mapApply->building_category->value ?? null,
            'structure_type_id' => $mapApply->structure_type_id ?? null,
            'structure_type' => $mapApply->structure_type ?? null,
            'current_storey' => $mapApply->current_storey ?? null,
            'area_of_plinth' => $mapApply->area_of_plinth ?? null,
            'future_storey' => $mapApply->future_storey ?? null,
            'length' => $mapApply->length ?? null,
            'breadth' => $mapApply->breadth ?? null,
            'height' => $mapApply->height ?? null,
        ];

        $this->structureTypes = StructureType::latest()->get();
        $this->allDistricts = $districts;
    }

    public function setStructureType(): void
    {
        $this->open_structure_type = !$this->open_structure_type;
    }

    protected array $applyMapValidations = [
        'applyMap.construction_type' => ['required'],
        'applyMap.usage' => ['required'],
        'applyMap.building_category' => ['required'],
        'applyMap.structure_type_id' => ['nullable', 'exists:structure_types,id'],
        'applyMap.structure_type' => ['nullable'],
        'applyMap.current_storey' => ['required', 'numeric'],
        'applyMap.area_of_plinth' => ['required', 'numeric'],
        'applyMap.future_storey' => ['required', 'numeric'],
        'applyMap.length' => ['required', 'numeric'],
        'applyMap.breadth' => ['required', 'numeric'],
        'applyMap.height' => ['required', 'numeric'],
    ];

    public function rules(): array
    {
        return $this->applyMapValidations;
    }

    public function saveFormData(): void
    {
        if ($this->editForm) {
            $this->validate();
            DB::transaction(function () {
                if ($this->applyMap['structure_type']) {
                    $structure_type = StructureType::create(['title' => $this->applyMap['structure_type']]);

                    $this->applyMap['structure_type_id'] = $structure_type->id ?? '';
                }

                $this->mapApply->update($this->applyMap);
            });

            $this->reset('editForm');

            $this->dispatchBrowserEvent('alert_message', [
                'type' => 'success',
                'title' => 'धन्यबाद',
                'text' => 'तपाईको फारम सफलतापूर्वक दर्ता भयो',
            ]);
        }
    }

    public function messages(): array
    {
        return [
            'applyMap.construction_type.required' => 'निर्माण कार्यको किसिम अनिवार्य छ |',
            'applyMap.usage.required' => 'प्रयोजन अनिवार्य छ |',
            'applyMap.building_category.required' => ' भवनको वर्गीकरण अनिवार्य छ|',
            'applyMap.current_storey.required' => 'तल्ला संख्या अनिवार्य छ|',
            'applyMap.current_storey.numeric' => 'तल्ला संख्या नम्बरमा हुनुपर्छ|',
            'applyMap.area_of_plinth.required' => 'क्षेत्रफल अनिवार्य छ|',
            'applyMap.area_of_plinth.numeric' => 'क्षेत्रफल नम्बरमा हुनुपर्छ|',
            'applyMap.future_storey.required' => 'तल्ला संख्या अनिवार्य छ|',
            'applyMap.future_storey.numeric' => 'तल्ला संख्या नम्बरमा हुनुपर्छ|',
            'applyMap.length.required' => 'भवनको लम्बाई अनिवार्य छ|',
            'applyMap.length.numeric' => 'भवनको लम्बाई नम्बरमा हुनुपर्छ|',
            'applyMap.breadth.required' => 'भवनको चौडाई अनिवार्य छ|',
            'applyMap.breadth.numeric' => 'भवनको चौडाई नम्बरमा हुनुपर्छ|',
            'applyMap.height.required' => 'भवनको उचाई अनिवार्य छ|',
            'applyMap.height.numeric' => 'भवनको उचाई नम्बरमा हुनुपर्छ|',
        ];
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('emap::livewire.edit.map-apply-edit-livewire');
    }
}

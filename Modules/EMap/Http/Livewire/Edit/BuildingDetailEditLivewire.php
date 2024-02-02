<?php

namespace Modules\EMap\Http\Livewire\Edit;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\EMap\Entities\BuildingDetail;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Enums\BuildingDetailEnum;

class BuildingDetailEditLivewire extends Component
{
    public MapApply $mapApply;

    public array $buildingDetails = [];

    public ?int $dataToEdit = null;

    public function mount(MapApply $mapApply): void
    {
        $this->mapApply = $mapApply;
        $availableBuildingDetail = collect();
        foreach ($mapApply->buildingDetails as $buildingDetail) {
            $this->buildingDetails[] = [
                'id' => $buildingDetail->id ?? null,
                'detail' => $buildingDetail->detail->value ?? null,
                'description' => $buildingDetail->description ?? null,
                'remarks' => $buildingDetail->remarks ?? null,
            ];
            $availableBuildingDetail->push($buildingDetail->detail->value);
        }
        if (!$availableBuildingDetail->unique()->contains(BuildingDetailEnum::BUILDING_CATEGORY->value)) {
            $this->buildingDetails[] = [
                'detail' => BuildingDetailEnum::BUILDING_CATEGORY->value,
                'description' => $mapApply->building_category?->label(),
                'remarks' => null,
            ];
        }
        if (!$availableBuildingDetail->unique()->contains(BuildingDetailEnum::PLINTH_AREA->value)) {
            $this->buildingDetails[] = [
                'detail' => BuildingDetailEnum::PLINTH_AREA->value,
                'description' => $mapApply->area_of_plinth ?? null,
                'remarks' => null,
            ];
        }
        if (!$availableBuildingDetail->unique()->contains(BuildingDetailEnum::LENGTH->value)) {
            $this->buildingDetails[] = [
                'detail' => BuildingDetailEnum::LENGTH->value,
                'description' => $mapApply->length ?? '',
                'remarks' => null,
            ];
        }
        if (!$availableBuildingDetail->unique()->contains(BuildingDetailEnum::BREADTH->value)) {
            $this->buildingDetails[] = [
                'detail' => BuildingDetailEnum::BREADTH->value,
                'description' => $mapApply->breadth ?? '',
                'remarks' => null,
            ];
        }
        if (!$availableBuildingDetail->unique()->contains(BuildingDetailEnum::STOREY_COUNT->value)) {
            $this->buildingDetails[] = [
                'detail' => BuildingDetailEnum::STOREY_COUNT->value,
                'description' => $mapApply->current_storey ?? '',
                'remarks' => null,
            ];
        }
        if (!$availableBuildingDetail->unique()->contains(BuildingDetailEnum::HEIGHT->value)) {
            $this->buildingDetails[] = [
                'detail' => BuildingDetailEnum::HEIGHT->value,
                'description' => $mapApply->height ?? null,
                'remarks' => null,
            ];
        }
    }

    public function rules(): array
    {
        if ($this->dataToEdit === null) {
            return [];
        }

        return [
            'buildingDetails' => ['required', 'array'],
            'buildingDetails.'.$this->dataToEdit.'.detail' => ['required'],
            'buildingDetails.'.$this->dataToEdit.'.description' => ['required'],
            'buildingDetails.'.$this->dataToEdit.'.remarks' => ['nullable'],
        ];
    }

    public function setDataForEdit(?int $index = null): void
    {
        $this->dataToEdit = $index;
    }

    public function saveFormData(): void
    {
        if ($this->dataToEdit !== null) {
            $this->validate();
            DB::transaction(function () {
                $dataToSave = $this->buildingDetails[$this->dataToEdit];

                if (!empty($dataToSave['id'])) {
                    BuildingDetail::find($dataToSave['id'])?->update($dataToSave);
                } else {
                    BuildingDetail::create($dataToSave + ['map_apply_id' => $this->mapApply->id]);
                }
            });

            $this->reset('dataToEdit');

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
            'buildingDetails.required' => 'भवन सम्बन्धि विवरण अनिवार्य छ|',
            'buildingDetails.*.description.required' => 'विवरण अनिवार्य छ|',
        ];
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('emap::livewire.edit.building-detail-edit-livewire');
    }
}

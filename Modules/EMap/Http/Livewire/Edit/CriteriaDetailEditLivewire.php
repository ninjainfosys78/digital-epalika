<?php

namespace Modules\EMap\Http\Livewire\Edit;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\EMap\Entities\CriteriaDetail;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Enums\DetailsRegardingCriteriaEnum;

class CriteriaDetailEditLivewire extends Component
{
    public MapApply $mapApply;

    public array $criteriaDetails = [];

    public ?int $dataToEdit = null;

    public function mount(MapApply $mapApply): void
    {
        $this->mapApply = $mapApply;

        $availableCriteria = collect();
        foreach ($mapApply->criteriaDetails as $criteriaDetail) {
            $this->criteriaDetails[] = [
                'id' => $criteriaDetail->id ?? null,
                'detail' => $criteriaDetail->detail->value ?? null,
                'according_to_criteria' => $criteriaDetail->according_to_criteria ?? null,
                'according_to_map' => $criteriaDetail->according_to_map ?? null,
                'compliance' => $criteriaDetail->compliance ?? null,
                'remarks' => $criteriaDetail->remarks ?? null,
            ];
            $availableCriteria->push($criteriaDetail->detail->value);
        }

        foreach (DetailsRegardingCriteriaEnum::cases() as $criteria) {
            if (!$availableCriteria->unique()->contains($criteria->value)) {
                $this->criteriaDetails[] = [
                    'detail' => $criteria->value,
                    'according_to_criteria' => null,
                    'according_to_map' => null,
                    'compliance' => null,
                    'remarks' => $criteria->remarks(),
                ];
            }
        }
    }

    public function rules(): array
    {
        if ($this->dataToEdit === null) {
            return [];
        }

        return [
            'criteriaDetails' => ['required', 'array'],
            'criteriaDetails.'.$this->dataToEdit.'.detail' => ['required'],
            'criteriaDetails.'.$this->dataToEdit.'.according_to_criteria' => ['required'],
            'criteriaDetails.'.$this->dataToEdit.'.according_to_map' => ['required'],
            'criteriaDetails.'.$this->dataToEdit.'.compliance' => ['required'],
            'criteriaDetails.'.$this->dataToEdit.'.remarks' => ['nullable'],
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
                $dataToSave = $this->criteriaDetails[$this->dataToEdit];

                if (!empty($dataToSave['id'])) {
                    CriteriaDetail::find($dataToSave['id'])?->update($dataToSave);
                } else {
                    CriteriaDetail::create($dataToSave + ['map_apply_id' => $this->mapApply->id]);
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
            'criteriaDetails.required' => 'मापदण्ड विवरण अनिवार्य छ|',
            'criteriaDetails.*.according_to_criteria.required' => 'मापदण्ड अनुसार अनिवार्य छ|',
            'criteriaDetails.*.according_to_map.required' => 'नक्सा अनुसार अनिवार्य छ|',
            'criteriaDetails.*.compliance.required' => 'अनुपालन अनिवार्य छ|',
        ];
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('emap::livewire.edit.criteria-detail-edit-livewire');
    }
}

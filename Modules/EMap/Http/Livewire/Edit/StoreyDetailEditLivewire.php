<?php

namespace Modules\EMap\Http\Livewire\Edit;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Entities\MapFee;
use Modules\EMap\Entities\StoreyDetail;

class StoreyDetailEditLivewire extends Component
{
    public MapApply $mapApply;

    public $mapFees;

    public $storeyDetails = [];

    public ?int $dataToEdit = null;

    public function mount(MapApply $mapApply): void
    {
        $this->mapApply = $mapApply;

        $this->mapFees = MapFee::with('unit')->get();
        $mapApply->load('storeyDetails')->loadCount('storeyDetails');
        foreach ($mapApply->storeyDetails as $storeyDetail) {
            $this->storeyDetails[] = [
                'id' => $storeyDetail->id ?? null,
                'map_fee_id' => $storeyDetail->map_fee_id ?? null,
                'area_of_proposed_construction' => $storeyDetail->area_of_proposed_construction ?? null,
                'area_of_former_construction' => $storeyDetail->area_of_former_construction ?? null,
                'total_area' => $storeyDetail->total_area ?? null,
                'height' => $storeyDetail->height ?? null,
            ];
        }

        if ($mapApply->storey_details_count < $mapApply->current_storey) {
            for ($i = $mapApply->storey_details_count; $i < $mapApply->current_storey; $i++) {
                $this->storeyDetails[] = [];
            }
        }
    }

    public function deleteData(?int $index = null): void
    {
        if ($index !== null) {
            $dataToDelete = $this->storeyDetails[$index];
            if (!empty($dataToDelete['id'])) {
                StoreyDetail::find($dataToDelete['id'])?->delete();

                unset($this->storeyDetails[$index]);
                $this->storeyDetails = array_values($this->storeyDetails);
            }
        }
    }

    public function rules(): array
    {
        if ($this->dataToEdit === null) {
            return [];
        }

        return [
            'storeyDetails' => ['nullable', 'array'],
            'storeyDetails.'.$this->dataToEdit.'.map_fee_id' => ['required', 'exists:map_fees,id'],
            'storeyDetails.'.$this->dataToEdit.'.area_of_proposed_construction' => ['required', 'numeric'],
            'storeyDetails.'.$this->dataToEdit.'.area_of_former_construction' => ['nullable', 'numeric'],
            'storeyDetails.'.$this->dataToEdit.'.total_area' => ['required', 'numeric'],
            'storeyDetails.'.$this->dataToEdit.'.height' => ['required', 'numeric'],
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
                $dataToSave = $this->storeyDetails[$this->dataToEdit];

                if (!empty($dataToSave['id'])) {
                    StoreyDetail::find($dataToSave['id'])?->update($dataToSave);
                } else {
                    StoreyDetail::create($dataToSave + ['map_apply_id' => $this->mapApply->id]);
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
            'storeyDetails.*.map_fee_id.required' => 'तल्ला अनिवार्य छ|',
            'storeyDetails.*.area_of_proposed_construction.required' => ' प्रस्तावित  क्षेत्रफल अनिवार्य छ|',
            'storeyDetails.*.area_of_proposed_construction.numeric' => 'प्रस्तावित  क्षेत्रफल नम्बरमा हुनुपर्छ|',
            'storeyDetails.*.area_of_former_construction.required' => 'साविक क्षेत्रफल अनिवार्य छ|',
            'storeyDetails.*.area_of_former_construction.numeric' => 'साविक क्षेत्रफल नम्बरमा हुनुपर्छ|',
            'storeyDetails.*.total_area.required' => 'जम्मा क्षेत्रफल अनिवार्य छ|',
            'storeyDetails.*.total_area.numeric' => 'जम्मा क्षेत्रफल नम्बरमा हुनुपर्छ|',
            'storeyDetails.*.height.required' => 'उचाई अनिवार्य छ|',
            'storeyDetails.*.height.numeric' => 'उचाई नम्बरमा हुनुपर्छ|',
        ];
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('emap::livewire.edit.storey-detail-edit-livewire');
    }
}

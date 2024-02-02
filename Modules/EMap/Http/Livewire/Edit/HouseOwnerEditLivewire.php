<?php

namespace Modules\EMap\Http\Livewire\Edit;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\EMap\Entities\MapApply;

class HouseOwnerEditLivewire extends Component
{
    public MapApply $mapApply;

    public array $houseOwner = [
        'name' => null,
        'phone' => null,
        'father_name' => null,
        'grandfather_name' => null,
        'citizenship_issue_district_id' => null,
        'citizenship_no' => null,
        'citizenship_issue_date' => null,
        'address' => null,
        'local_body' => null,
        'ward_no' => null,
    ];

    protected array $houseOwnerValidations = [
        'houseOwner.name' => ['required'],
        'houseOwner.phone' => ['nullable'],
        'houseOwner.father_name' => ['required'],
        'houseOwner.grandfather_name' => ['required'],
        'houseOwner.citizenship_issue_district_id' => ['required', 'exists:districts,id'],
        'houseOwner.citizenship_no' => ['required'],
        'houseOwner.citizenship_issue_date' => ['required'],
        'houseOwner.address' => ['required'],
        'houseOwner.local_body' => ['required'],
        'houseOwner.ward_no' => ['required', 'integer'],
    ];

    public bool $editForm = false;

    public $allDistricts;

    public function mount(MapApply $mapApply, $districts)
    {
        $this->mapApply = $mapApply;
        $this->allDistricts = $districts;

        $this->houseOwner = [
            'name' => $mapApply->houseOwner?->name ?? null,
            'phone' => $mapApply->houseOwner?->phone ?? null,
            'father_name' => $mapApply->houseOwner?->father_name ?? null,
            'grandfather_name' => $mapApply->houseOwner?->grandfather_name ?? null,
            'citizenship_issue_district_id' => $mapApply->houseOwner?->citizenship_issue_district_id ?? null,
            'citizenship_no' => $mapApply->houseOwner?->citizenship_no ?? null,
            'citizenship_issue_date' => $mapApply->houseOwner?->citizenship_issue_date ?? null,
            'address' => $mapApply->houseOwner?->address ?? null,
            'local_body' => $mapApply->houseOwner?->local_body ?? null,
            'ward_no' => $mapApply->houseOwner?->ward_no ?? null,
        ];
    }

    public function setEditForm(): void
    {
        $this->editForm = !$this->editForm;
    }

    public function rules(): array
    {
        return $this->houseOwnerValidations;
    }

    public function messages(): array
    {
        return [
            'houseOwner.name.required' => 'घर धनीको नाम अनिवार्य छ|',
            'houseOwner.father_name.required' => 'बुवाको नाम अनिवार्य छ|',
            'houseOwner.citizenship_issue_district_id.required' => 'जिल्ला अनिवार्य छ|',
            'houseOwner.citizenship_no.required' => ' नागरिकत नम्बर अनिवार्य छ|',
            'houseOwner.citizenship_issue_date.required' => 'मिति अनिवार्य छ|',
            'houseOwner.address.required' => 'ठेगाना अनिवार्य छ|',
        ];
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function saveFormData(): void
    {
        if ($this->editForm) {
            $this->validate();
            DB::transaction(function () {
                $this->mapApply->houseOwner()->update($this->houseOwner);
            });

            $this->reset('editForm');

            $this->dispatchBrowserEvent('alert_message', [
                'type' => 'success',
                'title' => 'धन्यबाद',
                'text' => 'तपाईको फारम सफलतापूर्वक दर्ता भयो',
            ]);
        }
    }

    public function render()
    {
        return view('emap::livewire.edit.house-owner-edit-livewire');
    }
}

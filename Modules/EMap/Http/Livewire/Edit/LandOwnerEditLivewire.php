<?php

namespace Modules\EMap\Http\Livewire\Edit;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\EMap\Entities\MapApply;

class LandOwnerEditLivewire extends Component
{
    public MapApply $mapApply;

    public $allDistricts = [];

    public bool $editForm = false;

    public function mount(MapApply $mapApply, $districts)
    {
        $this->mapApply = $mapApply;
        $this->allDistricts = $districts;

        $this->landOwner = [
            'land_owner_type' => $mapApply->landOwner?->land_owner_type ?? null,
            'name' => $mapApply->landOwner?->name ?? null,
            'phone' => $mapApply->landOwner?->phone ?? null,
            'father_name' => $mapApply->landOwner?->father_name ?? null,
            'grandfather_name' => $mapApply->landOwner?->grandfather_name ?? null,
            'citizenship_issue_district_id' => $mapApply->landOwner?->citizenship_issue_district_id ?? null,
            'citizenship_no' => $mapApply->landOwner?->citizenship_no ?? null,
            'citizenship_issue_date' => $mapApply->landOwner?->citizenship_issue_date ?? null,
            'address' => $mapApply->landOwner?->address ?? null,
            'local_body' => $mapApply->landOwner?->local_body ?? null,
            'ward_no' => $mapApply->landOwner?->ward_no ?? null,
        ];
    }

    public function setEditForm(): void
    {
        $this->editForm = !$this->editForm;
    }

    public array $landOwner = [
        'land_owner_type' => null,
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

    protected array $landOwnerValidations = [
        'landOwner.land_owner_type' => ['required'],
        'landOwner.name' => ['required'],
        'landOwner.phone' => ['nullable'],
        'landOwner.father_name' => ['required'],
        'landOwner.grandfather_name' => ['required'],
        'landOwner.citizenship_issue_district_id' => ['required', 'exists:districts,id'],
        'landOwner.citizenship_no' => ['required'],
        'landOwner.citizenship_issue_date' => ['required'],
        'landOwner.address' => ['required'],
        'landOwner.local_body' => ['required'],
        'landOwner.ward_no' => ['required', 'integer'],
    ];

    public function rules(): array
    {
        return $this->landOwnerValidations;
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
                $this->mapApply->landOwner()->update($this->landOwner);
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
            'landOwner.land_owner_type.required' => 'जग्गा धनीको किसिम अनिवार्य छ|',
            'landOwner.name.required' => 'नाम अनिवार्य छ|',
            'landOwner.father_name.required' => ' बुवाको नाम अनिवार्य छ|',
            'landOwner.citizenship_issue_district_id.required' => 'जिल्ला अनिवार्य छ|',
            'landOwner.citizenship_no.required' => 'नागरिकत नम्बर अनिवार्य छ|',
            'landOwner.citizenship_issue_date.required' => ' मिति अनिवार्य छ|',
            'landOwner.address.required' => ' ठेगाना अनिवार्य छ|',
        ];
    }

    public function render()
    {
        return view('emap::livewire.edit.land-owner-edit-livewire');
    }
}

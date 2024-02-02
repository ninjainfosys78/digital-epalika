<?php

namespace Modules\EMap\Http\Livewire\Edit;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\EMap\Entities\MapApply;

class ApplicantDetailEditLivewire extends Component
{
    use WithFileUploads;

    public MapApply $mapApply;

    public $allDistricts = [];

    public bool $editForm = false;

    public $signature;

    public $signatureUrl;

    public array $applicantDetail = [
        'applicant_type' => null,
        'relation_with_owner' => null,
        'name' => null,
        'phone' => null,
        'father_name' => null,
        'citizenship_issue_district_id' => null,
        'citizenship_no' => null,
        'citizenship_issue_date' => null,
        'application_date' => null,
    ];

    public function mount(MapApply $mapApply, $districts)
    {
        $this->mapApply = $mapApply;
        $this->allDistricts = $districts;

        $this->applicantDetail = [
            'applicant_type' => $mapApply->applicantDetail->applicant_type->value ?? null,
            'relation_with_owner' => $mapApply->applicantDetail->relation_with_owner->value ?? null,
            'name' => $mapApply->applicantDetail->name ?? null,
            'phone' => $mapApply->applicantDetail->phone ?? null,
            'father_name' => $mapApply->applicantDetail->father_name ?? null,
            'citizenship_issue_district_id' => $mapApply->applicantDetail->citizenship_issue_district_id ?? null,
            'citizenship_no' => $mapApply->applicantDetail->citizenship_no ?? null,
            'citizenship_issue_date' => $mapApply->applicantDetail->citizenship_issue_date ?? null,
            'application_date' => $mapApply->applicantDetail->application_date ?? null,
        ];
        $this->signatureUrl = $mapApply->applicantDetail->signature_url ?? null;
    }

    public function setEditForm(): void
    {
        $this->editForm = !$this->editForm;
    }

    public function rules(): array
    {
        return $this->applicantDetailValidations;
    }

    protected array $applicantDetailValidations = [
        'applicantDetail.applicant_type' => ['required'],
        'applicantDetail.relation_with_owner' => ['required'],
        'applicantDetail.name' => ['required'],
        'applicantDetail.phone' => ['required'],
        'applicantDetail.father_name' => ['required'],
        'applicantDetail.citizenship_issue_district_id' => ['required'],
        'applicantDetail.citizenship_no' => ['required'],
        'applicantDetail.citizenship_issue_date' => ['required'],
        'applicantDetail.application_date' => ['nullable'],
        'signature' => ['nullable', 'image'],
    ];

    public function messages(): array
    {
        return [
            'applicantDetail.applicant_type.required' => 'निवेदकको प्रकार अनिवार्य छ|',
            'applicantDetail.relation_with_owner.required' => ' सम्बन्ध अनिवार्य छ|',
            'applicantDetail.name.required' => 'नाम अनिवार्य छ|',
            'applicantDetail.phone.required' => 'फोन न. अनिवार्य छ|',
            'applicantDetail.father_name.required' => 'वाबुको नाम अनिवार्य छ|',
            'applicantDetail.citizenship_issue_district_id.required' => 'जारी जिल्ला अनिवार्य छ|',
            'applicantDetail.citizenship_no.required' => 'नागरिकता न. अनिवार्य छ|',
            'applicantDetail.citizenship_issue_date.required' => 'जारी मिति अनिवार्य छ|',
            'signature.required' => 'निवेदकको सहि अनिवार्य छ|',
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
                $this->mapApply->applicantDetail()->update($this->applicantDetail);

                if ($this->signature) {
                    $this->mapApply->update([
                        'signature' => $this->signature->store('e_map/applicant/'.Str::slug(($this->mapApply->houseOwner->name ?? 'default'), '_').'/signature', 'public'),
                    ]);
                }
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
        return view('emap::livewire.edit.applicant-detail-edit-livewire');
    }
}

<?php

namespace Modules\EMap\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\EMap\Entities\Organization;

class OrganizationRegisterPersonLivewire extends Component
{
    use WithFileUploads;

    public int $currentStep = 1;

    public float $progressPercentage = 0;

    public $is_same_as_permanent = false;

    public $districts = [];

    public $provinces = [];

    public array $address = [
        'permanentProvince' => null,
        'permanentDistrict' => null,
        'permanentLocalBody' => null,
        'temporaryProvince' => null,
        'temporaryDistrict' => null,
        'temporaryLocalBody' => null,
        'citizenshipIssuedDistrict' => null,
        'permanentLocalBodies' => [],
        'permanentWards' => [],
        'permanentDistricts' => [],
        'temporaryLocalBodies' => [],
        'temporaryWards' => [],
        'temporaryDistricts' => [],

    ];

    public array $user = [
        'name' => null,
        'email' => null,
        'phone' => null,
    ];

    public array $userDetail = [
        'name_ne' => null,
        'name_en' => null,
        'email' => null,
        'phone' => null,
        'gender' => null,
        'marital_status' => null,
        'father_name' => null,
        'grandfather_name' => null,
        'pan_no' => null,
        'nec_no' => null,
        'nec_certificate' => null,
        'citizenship_no' => null,
        'citizenship_issued_district' => null,
        'citizenship_issued_date' => null,
        'citizenship_front' => null,
        'citizenship_back' => null,
        'permanent_province_id' => null,
        'permanent_district_id' => null,
        'permanent_local_body_id' => null,
        'permanent_ward' => null,
        'permanent_tole' => null,
        'temporary_province_id' => null,
        'temporary_district_id' => null,
        'temporary_local_body_id' => null,
        'temporary_ward' => null,
        'temporary_tole' => null,
    ];

    protected array $firstStepValidations = [
        'userDetail.name_ne' => ['required'],
        'userDetail.name_en' => ['required'],
        'userDetail.email' => ['required', 'email'],
        'userDetail.phone' => ['required'],
        'userDetail.gender' => ['required'],
        'userDetail.marital_status' => ['nullable'],
        'userDetail.father_name' => ['required'],
        'userDetail.grandfather_name' => ['required'],
    ];

    protected array $secondStepValidations = [
        'userDetail.pan_no' => ['required'],
        'userDetail.nec_no' => ['required'],
        'userDetail.nec_certificate' => ['required', 'image', 'max:300'],
        'userDetail.citizenship_no' => ['required'],
        'userDetail.citizenship_issued_district' => ['required', 'exists:districts,id,deleted_at,NULL'],
        'userDetail.citizenship_issued_date' => ['required'],
        'userDetail.citizenship_front' => ['required', 'image', 'max:300'],
        'userDetail.citizenship_back' => ['nullable', 'image', 'max:300'],
    ];

    protected array $thirdStepValidations = [
        'userDetail.permanent_province_id' => ['required', 'exists:provinces,id,deleted_at,NULL'],
        'userDetail.permanent_district_id' => ['required', 'exists:districts,id,deleted_at,NULL'],
        'userDetail.permanent_local_body_id' => ['required', 'exists:local_bodies,id,deleted_at,NULL'],
        'userDetail.permanent_ward' => ['required'],
        'userDetail.permanent_tole' => ['nullable'],
        'userDetail.temporary_province_id' => ['required', 'exists:provinces,id,deleted_at,NULL'],
        'userDetail.temporary_district_id' => ['required', 'exists:districts,id,deleted_at,NULL'],
        'userDetail.temporary_local_body_id' => ['required', 'exists:local_bodies,id,deleted_at,NULL'],
        'userDetail.temporary_ward' => ['required'],
        'userDetail.temporary_tole' => ['nullable'],
    ];

    protected array $fourthStepValidations = [
        'user.name' => ['required'],
        'user.email' => ['required', 'email', 'unique:organizations,email'],
        'user.phone' => ['required', 'unique:organizations,phone'],
    ];

    public function mount(): void
    {
        $this->districts = get_districts();
        $this->provinces = get_provinces();
    }

    public function nextStep($step): void
    {
        $this->validate();
        $this->currentStep = $step;
        $this->calculateProgressPercentage();
    }

    public function backStep($step): void
    {
        $this->currentStep = $step;
        $this->calculateProgressPercentage();
    }

    protected function rules(): array
    {
        return match ($this->currentStep) {
            2 => $this->secondStepValidations,
            3 => $this->thirdStepValidations,
            4 => $this->fourthStepValidations,
            default => $this->firstStepValidations,
        };
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function submitFormData(): void
    {
        $this->validate();
        DB::transaction(function () {
            $DbUser = Organization::create($this->user + [
                'is_organization' => 0,
            ]);
            $DbUser->userDetail()->create($this->userDetail);
            $this->resetForm();
        });
        $this->dispatchBrowserEvent('alert_message', [
            'type' => 'success',
            'title' => 'धन्यबाद',
            'text' => 'तपाईको फारम सफलतापूर्वक दर्ता भयो',
        ]);
    }

    public function resetForm(): void
    {
        $this->reset('is_same_as_permanent', 'currentStep', 'address', 'userDetail', 'user', 'progressPercentage');
    }

    public function checkPermanentAddress(): void
    {
        if (!empty($this->userDetail['permanent_province_id'])) {
            $this->address['permanentDistricts'] = get_districts(province_ids: [$this->userDetail['permanent_province_id']]);
            $this->address['permanentProvince'] = $this->provinces->firstWhere('id', $this->userDetail['permanent_province_id']);
        }
        if (!empty($this->userDetail['permanent_district_id'])) {
            $this->address['permanentLocalBodies'] = get_local_bodies(district_ids: [$this->userDetail['permanent_district_id']]);
            $this->address['permanentDistrict'] = $this->address['permanentDistricts']->firstWhere('id', $this->userDetail['permanent_district_id']);
        }
        if (!empty($this->userDetail['permanent_local_body_id'])) {
            $this->address['permanentWards'] = get_local_bodies(localBodyId: $this->userDetail['permanent_local_body_id'])->ward_no;
            $this->address['permanentLocalBody'] = $this->address['permanentLocalBodies']->firstWhere('id', $this->userDetail['permanent_local_body_id']);
        }
    }

    public function checkTemporaryAddress(): void
    {
        if (!empty($this->userDetail['temporary_province_id'])) {
            $this->address['temporaryDistricts'] = get_districts(province_ids: [$this->userDetail['temporary_province_id']]);
            $this->address['temporaryProvince'] = $this->provinces->firstWhere('id', $this->userDetail['temporary_province_id']);
        }
        if (!empty($this->userDetail['temporary_district_id'])) {
            $this->address['temporaryLocalBodies'] = get_local_bodies(district_ids: [$this->userDetail['temporary_district_id']]);
            $this->address['temporaryDistrict'] = $this->address['temporaryDistricts']->firstWhere('id', $this->userDetail['temporary_district_id']);
        }
        if (!empty($this->userDetail['temporary_local_body_id'])) {
            $this->address['temporaryWards'] = get_local_bodies(localBodyId: $this->userDetail['temporary_local_body_id'])->ward_no;
            $this->address['temporaryLocalBody'] = $this->address['temporaryLocalBodies']->firstWhere('id', $this->userDetail['temporary_local_body_id']);
        }
    }

    public function checkSameAsPermanentAddress(): void
    {
        $this->is_same_as_permanent = !$this->is_same_as_permanent;

        if ($this->is_same_as_permanent) {
            $this->address['temporaryDistricts'] = $this->address['permanentDistricts'] ?? [];
            $this->address['temporaryLocalBodies'] = $this->address['permanentLocalBodies'] ?? [];
            $this->address['temporaryWards'] = $this->address['permanentWards'] ?? [];
            $this->userDetail['temporary_province_id'] = $this->userDetail['permanent_province_id'] ?? null;
            $this->userDetail['temporary_district_id'] = $this->userDetail['permanent_district_id'] ?? null;
            $this->userDetail['temporary_local_body_id'] = $this->userDetail['permanent_local_body_id'] ?? null;
            $this->userDetail['temporary_ward'] = $this->userDetail['permanent_ward'] ?? null;
            $this->userDetail['temporary_tole'] = $this->userDetail['permanent_tole'] ?? null;
        } else {
            $this->address['temporaryDistricts'] = [];
            $this->address['temporaryLocalBodies'] = [];
            $this->address['temporaryWards'] = [];
            $this->userDetail['temporary_province_id'] = null;
            $this->userDetail['temporary_district_id'] = null;
            $this->userDetail['temporary_local_body_id'] = null;
            $this->userDetail['temporary_ward'] = null;
            $this->userDetail['temporary_tole'] = null;
        }
    }

    private function calculateProgressPercentage()
    {
        $this->reset('progressPercentage');
        $this->progressPercentage = $this->currentStep / 5 * 100;
    }

    public function messages(): array
    {
        return [
            'userDetail.name_ne.required' => 'नेपालीमा नाम आवश्यक छ ।',
            'userDetail.name_en.required' => 'अंग्रेजीमा नाम आवश्यक छ ।',
            'userDetail.email.required' => 'इमेल आवश्यक छ ।',
            'userDetail.email.email' => 'इमेल मान्य छैन ।',
            'userDetail.phone.required' => 'सम्पर्क नं आवश्यक छ ।',
            'userDetail.gender.required' => 'लिङ्ग आवश्यक छ ।',
            'userDetail.father_name.required' => 'बुबाको नाम आवश्यक छ ।',
            'userDetail.grandfather_name.required' => 'हजुरबुबाको नाम आवश्यक छ ।',
            'userDetail.citizenship_no.required' => 'नागरिकता नम्बर आवश्यक छ ।',
            'userDetail.citizenship_issued_district.required' => ' नागरिकता जारी गरिएको जिल्ला आवश्यक छ ।',
            'userDetail.citizenship_issued_date.required' => 'नागरिकता जारी गरिएको मिति आवश्यक छ ।',
            'userDetail.pan_no.required' => 'पाना नं आवश्यक छ।',
            'userDetail.nec_no.required' => 'NEC नं आवश्यक छ।',
            'userDetail.nec_certificate.required' => 'NEC को प्रमाणपत्र आवश्यक छ।',
            'userDetail.nec_certificate.max' => 'NEC को प्रमाणपत्रको अधिकतम साइज ३०० केबी ।',
            'userDetail.citizenship_front.required' => 'नागरिकताको फोटो आवश्यक छ।',
            'userDetail.citizenship_back.max' => 'नागरिकताको फोटो आवश्यक छ।',
            'userDetail.citizenship_back.image' => 'नागरिकताको फोटो आवश्यक छ।',
            'userDetail.citizenship_front.max' => 'कागजात अधिकतम साइज २०० केबी ।',
            'userDetail.citizenship_front.image' => 'फाइल फोटोमा हुनुपर्छ ।',
            'userDetail.permanent_province_id.required' => 'स्थायी प्रदेश आवश्यक छ ।',
            'userDetail.permanent_district_id.required' => 'स्थायी जिल्ला आवश्यक छ ।',
            'userDetail.permanent_local_body_id.required' => 'स्थायी पालिका आवश्यक छ ।',
            'userDetail.permanent_ward.required' => 'स्थायी वडा नं आवश्यक छ ।',
            'userDetail.temporary_province_id.required' => 'अस्थायी प्रदेश आवश्यक छ ।',
            'userDetail.temporary_district_id.required' => 'अस्थायी जिल्ला आवश्यक छ ।',
            'userDetail.temporary_local_body_id.required' => 'अस्थायी पालिका आवश्यक छ ।',
            'userDetail.temporary_ward.required' => 'अस्थायी वडा नं आवश्यक छ ।',
            'user.name.required' => 'प्रयोगकर्ताको नाम आवश्यक छ ।',
            'user.name.unique' => 'यो संगठन पहिल्यै भई सकेको छ ।',
            'user.email.required' => 'इमेल आवश्यक छ ।',
            'user.email.unique' => 'यो इमेल पहिल्यै दर्ता भई सकेको छ ।',
            'user.email.email' => 'इमेल मान्य छैन ।',
            'user.phone.required' => 'सम्पर्क नं आवश्यक छ ।',
            'user.phone.unique' => 'यो सम्पर्क नं पहिल्यै प्रयोग भई सकेको छ ।',
        ];
    }

    public function render()
    {
        $this->checkPermanentAddress();
        $this->checkTemporaryAddress();

        if (!empty($this->userDetail['citizenship_issued_district'])) {
            $this->address['citizenshipIssuedDistrict'] = $this->districts->firstWhere('id', $this->userDetail['citizenship_issued_district']);
        }

        return view('emap::livewire.organization-register-person-livewire');
    }
}

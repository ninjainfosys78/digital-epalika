<?php

namespace Modules\EMap\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\EMap\Entities\Organization;

class OrganizationRegisterLivewire extends Component
{
    use WithFileUploads;

    public int $currentStep = 1;

    public float $progressPercentage = 0;

    public $districts = [];

    public $provinces = [];

    public array $address = [

        'organizationProvince' => null,
        'organizationDistrict' => null,
        'organizationLocalBody' => null,
        'organizationLocalBodies' => [],
        'organizationWards' => [],
        'organizationDistricts' => [],
    ];

    public array $user = [
        'name' => null,
        'email' => null,
        'phone' => null,
    ];

    public array $organizationDetail = [
        'org_name_ne' => null,
        'org_name_en' => null,
        'org_email' => null,
        'org_contact' => null,
        'org_registration_no' => null,
        'org_registration_document' => null,
        'org_pan_no' => null,
        'org_pan_document' => null,
        'logo' => null,
        'province_id' => null,
        'district_id' => null,
        'local_body_id' => null,
        'ward' => null,
        'tole' => null,
    ];

    public array $taxClearance = [
        'document' => null,
        'year' => null,
    ];

    public array $muncipalRegistration = [
        'palika_reg_no' => null,
        'reg_date' => null,
        'file' => null
    ];

    protected array $firstStepValidations = [
        'organizationDetail.org_name_ne' => ['required'],
        'organizationDetail.org_name_en' => ['required'],
        'organizationDetail.org_email' => ['required'],
        'organizationDetail.org_contact' => ['required'],
        'organizationDetail.org_registration_no' => ['required'],
        'organizationDetail.org_pan_no' => ['required'],
        'organizationDetail.province_id' => ['required', 'exists:provinces,id,deleted_at,NULL'],
        'organizationDetail.district_id' => ['required', 'exists:districts,id,deleted_at,NULL'],
        'organizationDetail.local_body_id' => ['required', 'exists:local_bodies,id,deleted_at,NULL'],
        'organizationDetail.ward' => ['required'],
        'organizationDetail.tole' => ['nullable'],
    ];

    protected array $secondStepValidations = [
        'organizationDetail.org_registration_document' => ['required', 'image', 'max:300'],
        'organizationDetail.org_pan_document' => ['required', 'image', 'max:300'],
        'organizationDetail.logo' => ['required', 'image', 'max:200'],
        'taxClearance.document' => ['required', 'max:300'],
        'taxClearance.year' => ['required'],
        'muncipalRegistration.palika_reg_no' => ['required'],
        'muncipalRegistration.reg_date' => ['required'],
        'muncipalRegistration.file' => ['required', 'file'],
    ];

    protected array $thirdStepValidations = [
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
            $DbUser = Organization::create($this->user);
            $DbOrgDetail = $DbUser->organizationDetail()->create($this->organizationDetail);
            $DbOrgDetail->taxClearances()->create($this->taxClearance);
            $DbOrgDetail->emapMuncipalRegistrations()->create($this->muncipalRegistration);

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
        $this->reset('currentStep', 'address', 'user', 'organizationDetail', 'taxClearance', 'progressPercentage');
    }

    public function checkOrganizationAddress(): void
    {
        if (!empty($this->organizationDetail['province_id'])) {
            $this->address['organizationDistricts'] = get_districts(province_ids: [$this->organizationDetail['province_id']]);
            $this->address['organizationProvince'] = get_provinces(provinceId: $this->organizationDetail['province_id']);
        }
        if (!empty($this->organizationDetail['district_id'])) {
            $this->address['organizationLocalBodies'] = get_local_bodies(district_ids: [$this->organizationDetail['district_id']]);
            $this->address['organizationDistrict'] = get_districts(districtId: $this->organizationDetail['district_id']);
        }
        if (!empty($this->organizationDetail['local_body_id'])) {
            $this->address['organizationWards'] = get_local_bodies(localBodyId: $this->organizationDetail['local_body_id'])->ward_no;
            $this->address['organizationLocalBody'] = $this->address['organizationLocalBodies']->firstWhere('id', $this->organizationDetail['local_body_id']);
        }
    }

    public function render(): Factory|View|Application
    {
        $this->checkOrganizationAddress();

        if (!empty($this->userDetail['citizenship_issued_district'])) {
            $this->address['citizenshipIssuedDistrict'] = get_districts(districtId: $this->userDetail['citizenship_issued_district']);
        }

        return view('emap::livewire.organization-register-livewire');
    }

    private function calculateProgressPercentage()
    {
        $this->reset('progressPercentage');
        $this->progressPercentage = $this->currentStep / 4 * 100;
    }

    public function messages(): array
    {
        return [

            'organizationDetail.org_name_ne.required' => 'संस्थाको नाम नेपालीमा आवश्यक छ । ',
            'organizationDetail.org_name_en.required' => 'संस्थाको नाम अंग्रेजीमा आवश्यक छ । ',
            'organizationDetail.org_email.required' => 'संस्थाको इमेल आवश्यक छ । ',
            'organizationDetail.org_contact.required' => 'संस्थाको सम्पर्क नं आवश्यक छ । ',
            'organizationDetail.org_registration_no.required' => 'संस्था दर्ता भएको नं आवश्यक छ ।',
            'organizationDetail.org_pan_no.required' => 'संस्थाको पाना नं आवश्यक छ । ',
            'organizationDetail.province_id.required' => 'प्रदेश आवश्यक छ ।',
            'organizationDetail.district_id.required' => 'जिल्ला आवश्यक छ ।',
            'organizationDetail.local_body_id.required' => 'पालिका आवश्यक छ ।',
            'organizationDetail.ward.required' => 'वडा नं आवश्यक छ ।',
            'organizationDetail.org_registration_document.required' => 'संस्था दर्ता भएको कागजात आवश्यक छ ।',
            'organizationDetail.org_registration_document.max' => 'कागजात अधिकतम साइज ३०० केबी ।',
            'organizationDetail.org_registration_document.image' => 'फाइल फोटोमा हुनुपर्छ ।',
            'organizationDetail.org_pan_document.required' => 'संस्थाको पाना नं को कागजात आवश्यक छ ।',
            'organizationDetail.org_pan_document.max' => 'कागजात अधिकतम साइज ३०० केबी ।',
            'organizationDetail.org_pan_document.image' => 'फाइल फोटोमा हुनुपर्छ ।',
            'organizationDetail.logo.required' => 'संस्थाको लोगो आवश्यक छ ।',
            'organizationDetail.logo.max' => 'कागजात अधिकतम साइज २०० केबी ।',
            'organizationDetail.logo.image' => 'फाइल फोटोमा हुनुपर्छ ।',
            'taxClearance.document.required' => 'संस्थाले कर तिरेको कागजात आवश्यक छ ।',
            'taxClearance.document.max' => 'कागजात अधिकतम साइज २०० केबी ।',
            'taxClearance.year.required' => 'संस्थाले कर तिरेको वर्ष आवश्यक छ ।',
            'user.name.required' => 'प्रयोगकर्ताको नाम आवश्यक छ ।',
            'user.name.unique' => 'यो संगठन पहिल्यै भई सकेको छ ।',
            'user.email.required' => 'इमेल आवश्यक छ ।',
            'user.email.unique' => 'यो इमेल पहिल्यै दर्ता भई सकेको छ ।',
            'user.email.email' => 'इमेल मान्य छैन ।',
            'user.phone.required' => 'सम्पर्क नं आवश्यक छ ।',
            'user.phone.unique' => 'यो सम्पर्क नं पहिल्यै प्रयोग भई सकेको छ ।',
        ];
    }
}

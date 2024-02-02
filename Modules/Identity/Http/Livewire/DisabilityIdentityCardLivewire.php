<?php

namespace Modules\Identity\Http\Livewire;

use App\Enums\StatusEnum;
use App\Models\Ethnicity;
use App\Models\Settings\OfficeSetting;
use App\Models\Settings\Relationship;
use App\Traits\NepaliDateConverter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Identity\Entities\DisabilityIdentityCard;
use Modules\Identity\Entities\DisabilityType;

class DisabilityIdentityCardLivewire extends Component
{
    use WithFileUploads;

    use NepaliDateConverter;

    public int $currentStep = 1;

    public $relations = [];
    public $disabilityTypes = [];

    public $ethnicities = [];

    public $provinces = [];

    public $districts = [];

    public $localBodies = [];


    public $wards = [];

    public DisabilityIdentityCard $disabilityIdentityCard;

    public array $form = [
        'name' => null,
        'name_en' => null,
        'citizenship_no' => null,
        'birth_registration_no' => null,
        'father_name' => null,
        'father_name_en' => null,
        'mother_name' => null,
        'mother_name_en' => null,
        'dob' => null,
        'dob_ad' => null,
        'gender' => null,
        'province_id' => null,
        'district_id' => null,
        'local_body_id' => null,
        'ward_no' => null,
        'tole' => null,
        'photo' => null,
        //step2
        'guardian_name' => null,
        'guardian_name_en' => null,
        'relationship_id' => null,
        'phone' => null,
        'disability_type_id' => null,


    ];

    public function mount($disabilityIdentityCard = null): void
    {
        if (empty($disabilityIdentityCard) && !empty(request('citizenship_no'))) {
            $this->form['citizenship_no'] = request('citizenship_no');
        }
        $officeSetting = OfficeSetting::first();
        $this->provinces = get_provinces();
        $this->ethnicities = Ethnicity::all();
        $this->relations = Relationship::all();
        $this->disabilityTypes = DisabilityType::all();

        if (!empty($disabilityIdentityCard)) {
            $this->disabilityIdentityCard = $disabilityIdentityCard;
            foreach ($this->form as $key => $data) {
                if (!in_array($key, ['photo'])) {
                    $this->form[$key] = $disabilityIdentityCard[$key];
                }
            }
        } else {
            $this->form['province_id'] = $officeSetting->province_id;
            $this->form['district_id'] = $officeSetting->district_id;
            $this->form['local_body_id'] = $officeSetting->local_body_id;
        }
    }

    protected $listeners = ['dobChanged'];


    public function dobChanged($nepaliDate, $englishDate): void
    {
        $this->form['dob'] = $nepaliDate;
        $this->form['dob_ad'] = $englishDate;
    }


    public function nextStep($step): void
    {
        $this->validate();
        $this->currentStep = $step;
    }

    public function backStep($step): void
    {
        $this->currentStep = $step;
    }

    protected array $identityDetailValidations = [
        'form.name' => ['required', 'string', 'max:255'],
        'form.name_en' => ['required', 'string', 'max:255'],
        'form.citizenship_no' => ['nullable'],
        'form.birth_registration_no' => ['nullable'],
        'form.father_name' => ['required', 'string', 'max:255'],
        'form.father_name_en' => ['required', 'string', 'max:255'],
        'form.mother_name' => ['required', 'string', 'max:255'],
        'form.mother_name_en' => ['required', 'string', 'max:255'],
        'form.dob' => ['required'],
        'form.gender' => ['required'],
        'form.province_id' => ['required', 'exists:provinces,id'],
        'form.district_id' => ['required', 'exists:districts,id'],
        'form.local_body_id' => ['required', 'exists:local_bodies,id'],
        'form.ward_no' => ['required', 'integer'],
        'form.tole' => ['required','string','max:255'],
        'form.disability_type_id' => ['required', 'exists:disability_types,id'],

    ];

    protected function firstStepValidations(): array
    {
        return !empty($this->disabilityIdentityCard)
            ? array_merge($this->identityDetailValidations, [
                'form.photo' => ['nullable'],
            ])
            : array_merge($this->identityDetailValidations, [
                'form.photo' => ['required'],
            ]);
    }

    protected array $secondStepValidations = [
        'form.guardian_name' => ['required', 'string', 'max:255'],
        'form.guardian_name_en' => ['required', 'string', 'max:255'],
        'form.relationship_id' => ['required', 'exists:relationships,id'],
        'form.phone' => ['required'],
    ];


    public function messages(): array
    {
        return [
            'form.name.required' => ['नाम आवश्यक छ'],
        ];
    }


    public function rules(): array
    {
        return match ($this->currentStep) {
            1 => $this->firstStepValidations(),
            2 => $this->secondStepValidations,

            default => array_merge(
                $this->firstStepValidations(),
                $this->secondStepValidations,
            ),
        };
    }


    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function saveForm(): RedirectResponse|Application|Redirector
    {
        $this->validate();
        if (!empty($this->disabilityIdentityCard)) {
            $this->disabilityIdentityCard->update($this->form);
            $this->dispatchBrowserEvent('toast_message', [
                'type' => 'success',
                'title' => 'अपाङ्गता परिचय पत्र सफलतापुर्बक अध्याबधिक भयो'
            ]);
            return redirect(route('identity.admin.disabilityIdentityCard.index'));
        } else {
            DB::transaction(function () {
                DisabilityIdentityCard::create($this->form + [
                        'status' => StatusEnum::PENDING->value
                    ]);
            });
            $this->dispatchBrowserEvent('toast_message', [
                'type' => 'success',
                'title' => 'अपाङ्गता परिचय पत्र सफलतापुर्बक दर्ता भयो'
            ]);
            $this->reset('form');
            return back();
        }
    }


    public function render(): Factory|View|Application
    {
        if (!empty($this->form['province_id'])) {
            $this->districts = get_districts($this->form['province_id']);
        }
        if (!empty($this->form['district_id'])) {
            $this->localBodies = get_local_bodies($this->form['district_id']);
        }
        if (!empty($this->form['local_body_id'])) {
            $this->wards = get_local_bodies(localBodyId: $this->form['local_body_id'])->ward_no;
        }
        return view('identity::livewire.disability-identity-card-livewire');
    }
}

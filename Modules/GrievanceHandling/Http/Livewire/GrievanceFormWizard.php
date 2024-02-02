<?php

namespace Modules\GrievanceHandling\Http\Livewire;

use App\Models\Settings\Branch;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\GrievanceHandling\Entities\GrievanceSetting;
use Modules\GrievanceHandling\Entities\GrievanceType;
use Modules\GrievanceHandling\Entities\GrievanceUser;
use Modules\GrievanceHandling\Enums\GrievanceMediumEnum;

class GrievanceFormWizard extends Component
{
    use WithFileUploads;

    public $grievanceTypes = [];

    public $branches = [];

    public int $currentStep = 1;

    public bool $is_password = false;
    public bool $isAnonymous = false;

    public $grievanceType;

    public $branch;
    public $is_anonymous;

    public array $form = [
        'grievance_type_id' => null,
        'description' => null,
        'branch_id' => null,
        'complaint_severity' => null,
        'subject' => null,
        'is_password' => 0,
        'password' => null,
        'password_confirmation' => null,
        'is_open' => 0,
        'is_anonymous' => 0,
        'name' => null,
        'email' => null,
        'phone' => null,
        'address' => null,
    ];

    protected array $firstStepValidations = [
        'form.grievance_type_id' => ['required', 'exists:grievance_types,id'],
        'form.description' => ['required'],
        'form.files' => ['nullable', 'array'],
        'form.files.*' => ['image', 'max:10240'],
        'form.branch_id' => ['required', 'exists:branches,id'],
        'form.complaint_severity' => ['required'],
        'form.subject' => ['required'],
    ];

    protected array $secondStepValidations = [
        'form.password' => ['required_if:is_password,1'],
        'form.password_confirmation' => ['nullable', 'confirmed'],
        'form.is_open' => ['nullable', 'boolean'],
        'form.is_anonymous' => ['nullable', 'boolean'],
        'form.name' => ['required'],
        'form.email' => ['required', 'email'],
        'form.phone' => ['required'],
        'form.address' => ['required'],
    ];

    public function mount()
    {
        $this->grievanceTypes = GrievanceType::all();
        $this->branches = Branch::all();
    }

    public function nextStep($step)
    {
        $this->validate();
        $this->currentStep = $step;
    }

    public function backStep($step)
    {
        $this->currentStep = $step;
    }

    public function rules()
    {
        return match ($this->currentStep) {
            2 => $this->secondStepValidations,
            default => $this->firstStepValidations
        };
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm()
    {
        $this->validate();
        $grievanceDetail = DB::transaction(function () {
            $grievanceUser = GrievanceUser::where('email', $this->form['email'])->first();
            if (empty($grievanceUser)) {
                $grievanceUser = GrievanceUser::create([
                    'name' => $this->form['name'],
                    'email' => $this->form['email'],
                    'phone' => $this->form['phone'],
                    'address' => $this->form['address'],
                    'password' => $this->form['password'] ?? '',
                ]);
            }
            $grievanceSetting = GrievanceSetting::first();

            $grievanceDetail = $grievanceUser->grievanceDetails()->create([
                'token' => time(),
                'grievance_type_id' => $this->form['grievance_type_id'],
                'description' => $this->form['description'],
                'branch_id' => $this->form['branch_id'],
                'complaint_severity' => $this->form['complaint_severity'],
                'subject' => $this->form['subject'],
                'is_open' => $this->form['is_open'],
                'is_anonymous' => $this->form['is_anonymous'],
                'grievance_medium' => GrievanceMediumEnum::SYSTEM,
                'assigned_user_id' => $grievanceSetting->user_id ?? User::first()->id,
                'assigned_at' => now()
            ]);
            if (!empty($this->form['files'])) {
                foreach ($this->form['files'] as $file) {
                    $grievanceDetail->files()->create([
                        'file_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                        'extension' => $file->getClientOriginalExtension(),
                        'file' => $file->store('grievance/files/' . Str::slug($grievanceUser->name, '_'), 'public'),
                    ]);
                }
            }

            $grievanceDetail->grievanceAssignHistories()->create([
                'user_id' => $grievanceDetail->assigned_user_id
            ]);

            //mail to assigned user
            // Mail::to($grievanceDetail->assignedUser->email)->send(new GrievanceRegistrationAssignedUserMail($grievanceDetail));

            // //mail to grievance user
            // if ($grievanceDetail->grievanceUser->email) {
            //     Mail::to($grievanceDetail->assignedUser->email)->send(new GrievanceRegistrationUserMail($grievanceDetail));
            // }

            return $grievanceDetail;
        });

        $this->reset('form', 'currentStep', 'is_password');

        $this->dispatchBrowserEvent('alert_message', [
            'type' => 'success',
            'title' => 'धन्यबाद',
            'text' => 'तपाईंको गुनासो फारम सफलतापूर्वक भएको छ, तपाईको गुनासो टोकन नम्बर ' . $grievanceDetail->token . ' हो, पछी हेर्नको लागि सुरक्षित राख्नुहोला',
        ]);
    }

    public function messages(): array
    {
        return [
            'form.grievance_type_id.required' => ['गुनासो प्रकार आवश्यक छ'],
            'form.description.required' => ['गुनासो विवरण आवश्यक छ'],
            'form.branch_id.required' => ['गुनासो कार्यालय आवश्यक छ'],
            'form.complaint_severity.required' => ['गुनासो गम्भीरता आवश्यक छ'],
            'form.subject.required' => ['गुनासो बिषय आवश्यक छ'],
            'form.password_confirmation.confirmed' => ['पासवोर्ड संग मेल खाएन '],
            'form.name.required' => ['नाम अनिबार्य छ '],
            'form.email.required' => ['इमेल अनिबार्य छ '],
            'form.email.email' => ['इमेल फर्ममा  छ '],
            'form.phone.required' => ['फोन अनिबार्य छ '],
            'form.address.required' => ['ठेगाना अनिबार्य छ '],
        ];
    }

    public function render()
    {
        if (!empty($this->form['grievance_type_id'])) {
            $this->grievanceType = GrievanceType::find($this->form['grievance_type_id']);
        }

        if (!empty($this->form['branch_id'])) {
            $this->branch = Branch::find($this->form['branch_id']);
        }

        return view('grievancehandling::livewire.grievance-form-wizard');
    }

    public function updatedIsAnonymous()
    {
        if ($this->isAnonymous) {
            $this->form['name'] = null;
            $this->form['email'] = null;
            $this->form['phone'] = null;
        }
    }
}

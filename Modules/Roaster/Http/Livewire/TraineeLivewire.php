<?php

namespace Modules\Roaster\Http\Livewire;

use App\Models\Address\Province;
use App\Models\Ethnicity;
use App\Models\Settings\Department;
use App\Models\Settings\Designation;
use App\Traits\AddressHelperTrait;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Roaster\Entities\Document;
use Modules\Roaster\Entities\Trainee;

class TraineeLivewire extends Component
{
    use WithFileUploads;
    use AddressHelperTrait;

    public $provinces = [];

    public $districts = [];

    public $localBodies = [];

    public $wards = [];

    public $ethnicities = [];
    public $designations = [];

    public $departments = [];

    public $form = [
        'full_name' => null,
        'citizenship_no' => null,
        'phone_no' => null,
        'email_id' => null,
        'qualification' => null,
        'gender' => null,
        'ethnicity_id' => null,
        'current_profession' => null,
        'province_id' => null,
        'district_id' => null,
        'local_body_id' => null,
        'ward_no' => null,
        'tole' => null,
        'is_employee' => null,
        'designation_id' => null,
        'department_id' => null,
        'service_time' => null,
        'office_name' => null,
        'office_address' => null,
        'office_phone' => null,
        'office_email' => null,
        'documents' => [],
    ];

    public $trainee;

    public $training;

    public function mount($trainee = null, $training = null)
    {
        $this->designations = Designation::all();
        $this->departments = Department::all();
        $this->trainee = $trainee;
        $this->training = $training;

        $this->provinces = Province::all();
        $this->ethnicities = Ethnicity::all();


        if (!empty($trainee)) {
            foreach ($this->form as $key => $data) {
                if ($key !== 'documents') {
                    $this->form[$key] = $trainee[$key];
                }
            }
            foreach ($trainee->documents as $document) {
                $this->form['documents'][] = [
                    'id' => $document->id,
                    'title' => $document->title,
                ];
            }
        }
    }

    public function rules(): array
    {
        if (empty($this->trainee)) {
            $this->validationRules = array_merge($this->validationRules, [
                'form.photo' => ['required', 'image', 'max:300'],
                'form.application_form' => ['required', 'mimes:jpg,jpeg,png,pdf'],
                'form.ward_recommendation' => ['required', 'mimes:jpg,jpeg,png,pdf'],
                'form.mark_sheet' => ['nullable', 'mimes:jpg,jpeg,png,pdf'],
                'form.citizenship_front' => ['required', 'mimes:jpg,jpeg,png,pdf'],
                'form.citizenship_back' => ['nullable', 'mimes:jpg,jpeg,png,pdf'],
                'form.passport' => ['nullable', 'mimes:jpg,jpeg,png,pdf'],
                'form.nomination_letter' => ['required', 'mimes:jpg,jpeg,png,pdf'],
                'form.recommendation_letter' => ['required', 'mimes:jpg,jpeg,png,pdf'],
                'form.documents.*.title' => ['required_with:form.documents', 'string'],
                'form.documents.*.document' => ['required_with:form.documents', 'file'],
            ]);
        } else {
            $this->validationRules = array_merge($this->validationRules, [
                'form.photo' => ['nullable', 'image', 'max:300'],
                'form.application_form' => ['nullable', 'mimes:pdf,jpg,jpeg,png'],
                'form.ward_recommendation' => ['nullable', 'mimes:pdf,jpg,jpeg,png'],
                'form.mark_sheet' => ['nullable', 'mimes:pdf,jpg,jpeg,png'],
                'form.citizenship_front' => ['nullable', 'mimes:pdf,jpg,jpeg,png'],
                'form.citizenship_back' => ['nullable', 'mimes:pdf,jpg,jpeg,png'],
                'form.passport' => ['nullable', 'mimes:pdf,jpg,jpeg,png'],
                'form.nomination_letter' => ['nullable', 'mimes:jpg,jpeg,png,pdf'],
                'form.recommendation_letter' => ['nullable', 'mimes:jpg,jpeg,png,pdf'],
                'form.documents.*.title' => ['nullable', 'string'],
                'form.documents.*.document' => ['nullable', 'file'],
            ]);
        }

        return $this->validationRules;
    }

    //real time validation
    public function updated($fields)
    {
        $this->validateOnly($fields, $this->rules());
    }

    public function save()
    {
        $validated = $this->validate()['form'];

        DB::transaction(function () use ($validated) {
            if (!empty($this->trainee)) {
                $trainee = $this->trainee;
                $trainee->update($validated);
                foreach ($this->form['documents'] as $document) {
                    if (array_key_exists('id', $document)) {
                        Document::find($document['id'])->update($document);
                    } else {
                        $trainee->documents()->create($document);
                    }
                }
                $this->dispatchBrowserEvent('alert_message', [
                    'type' => 'success',
                    'title' => 'Thank You',
                    'text' => 'Farmer Details Updated Successfully',
                ]);

                return redirect(route('traineeOrganization.admin.traineeList', $trainee->trainingTrainee->training_id));
            } else {
                $trainee = Trainee::create($validated);
                $trainee->trainingTrainee()->create([
                    'training_id' => $this->training->id,
                ]);

                foreach ($validated['documents'] as $document) {
                    $trainee->documents()->create($document);
                }
                $this->reset('form');
                $this->dispatchBrowserEvent('alert_message', [
                    'type' => 'success',
                    'title' => 'Thank You',
                    'text' => "तपाईंको फारम सफलतापूर्वक पेश गरियो र तपाईंको प्रशिक्षार्थी आईडी $trainee->reference_id हो। कृपया भविष्यमा प्रयोगको लागि आईडी सुरक्षित राख्नुहोस्।",
                ]);
            }
        });
    }

    public function removeDocuments($index)
    {
        if (isset($this->form['documents'][$index])) {
            $formDataType = $this->form['documents'][$index];

            if (isset($formDataType['id'])) {
                $formDataTypeRecord = Document::find($formDataType['id']);
                if ($formDataTypeRecord) {
                    $formDataTypeRecord->delete();
                }
            }
            $formDataTypeCollection = collect($this->form['documents']);
            $formDataTypeCollection->forget($index);

            $this->form['documents'] = $formDataTypeCollection->values()->all();
        }
    }

    public function documentsArrayIncrement()
    {
        $this->form['documents'][] = [];
    }

    public function documentsArrayDecrement($index)
    {
        if (array_key_exists('id', $this->form['documents'][$index])) {
            $this->removeDocuments($index);
        } else {
            $this->removeDocuments($index);
        }
    }

    protected $validationRules = [
        'form.full_name' => ['required', 'string', 'max:255'],
        'form.citizenship_no' => ['required', 'string', 'max:255'],
        'form.phone_no' => ['required', 'regex:/^([0-9,]*)$/'],
        'form.email_id' => ['nullable', 'email'],
        'form.ethnicity_id' => ['required', 'exists:ethnicities,id'],
        'form.qualification' => ['required', 'string', 'max:255'],
        'form.gender' => ['required'],
        'form.current_profession' => ['nullable', 'string'],
        'form.province_id' => ['required', 'exists:provinces,id'],
        'form.district_id' => ['required', 'exists:districts,id'],
        'form.local_body_id' => ['required', 'exists:local_bodies,id'],
        'form.ward_no' => ['required', 'integer'],
        'form.tole' => ['nullable', 'string', 'max:255'],
        'form.is_employee' => ['required'],
        'form.designation_id' => ['required_if:form.is_employee,==,1', 'exists:designations,id'],
        'form.department_id' => ['required_if:form.is_employee,==,1', 'exists:departments,id'],
        'form.service_time' => ['required_if:form.is_employee,==,1'],
        'form.office_name' => ['required_if:form.is_employee,==,1', 'string', 'max:255'],
        'form.office_address' => ['required_if:form.is_employee,==,1', 'string', 'max:255'],
        'form.office_phone' => ['required_if:form.is_employee,==,1'],
        'form.office_email' => ['required_if:form.is_employee,==,1', 'email'],
        'form.documents' => ['nullable', 'array'],
    ];

    protected $messages = [
        'form.full_name.required' => 'पूरा नाम आवश्यक छ ।',
        'form.citizenship_no.required' => 'नागरिकता नम्बर आवश्यक छ ।',
        'form.phone_no.required' => 'फोन नम्बर आवश्यक छ ।',
        'form.phone_no.regex' => 'फोन नम्बर 98XXXX,98XXXX ।',
        'form.email_id.required' => 'इमेल आवश्यक छ ।',
        'form.ethnicity_id.required' => 'जातियता आवश्यक छ ।',
        'form.qualification.required' => 'शैक्षिक योग्यता आवश्यक छ ।',
        'form.gender.required' => 'लिंग आवश्यक छ ।',
        'form.current_profession.required' => 'वर्तमान पेशा आवश्यक छ ।',
        'form.province_id.required' => 'प्रदेश आवश्यक छ ।',
        'form.district_id.required' => 'जिल्ला आवश्यक छ ।',
        'form.local_body_id.required' => 'स्थानीय निकाय आवश्यक छ ।',
        'form.ward_no.required' => 'वार्ड नम्बर आवश्यक छ ।',
        'form.tole.required' => 'टोल आवश्यक छ ।',
        'form.photo.required' => 'फोटो आवश्यक छ ।',
        'form.photo.max' => '300kb भन्दा कम मात्र ।',
        'form.application_form.required' => 'आवेदन फारम आवश्यक छ ।',
        'form.application_form.max' => '300kb भन्दा कम मात्र ।',
        'form.ward_recommendation.required' => 'वडाको सिफारिस आवश्यक छ ।',
        'form.ward_recommendation.max' => '300kb भन्दा कम मात्र ।',
        'form.citizenship_front.required' => 'नागरीकता (अगाडी) आवश्यक छ ।',
        'form.citizenship_front.max' => '300kb भन्दा कम मात्र ।',
        'form.citizenship_back.max' => '300kb भन्दा कम मात्र ।',
        'form.passport.max' => '300kb भन्दा कम मात्र ।',
        'form.mark_sheet.max' => '300kb भन्दा कम मात्र ।',
    ];

    public function render()
    {
        $this->getDependentAddressData();
        if ($this->form['is_employee'] == 0) {
            $this->form['designation_id'] = null;
            $this->form['department_id'] = null;
            $this->form['service_time'] = null;
            $this->form['office_name'] = null;
            $this->form['office_address'] = null;
            $this->form['office_phone'] = null;
            $this->form['office_email'] = null;
            $this->form['nomination_letter'] = null;
            $this->form['recommendation_letter'] = null;
        }

        return view('roaster::livewire.trainee-livewire');
    }
}

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
use Modules\Roaster\Entities\TechnicalTrainee;

class TechnicalTraineeLivewire extends Component
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
        'employee_name' => null,
        'designation_id' => null,
        'department_id' => null,
        'contact_no' => null,
        'service_time' => null,
        'email' => null,
        'education_qualification' => null,
        'province_id' => null,
        'district_id' => null,
        'local_body_id' => null,
        'ward_no' => null,
        'tole' => null,
        'office_name' => null,
        'office_address' => null,
        'office_phone' => null,
        'office_email' => null,
        'documents' => [],
    ];

    public $technicalTrainee;

    public $training;

    public function mount($technicalTrainee = null, $training = null)
    {
        $this->technicalTrainee = $technicalTrainee;
        $this->training = $training;

        $this->provinces = Province::all();
        $this->ethnicities = Ethnicity::all();
        $this->designations = Designation::all();
        $this->departments = Department::all();

        if (!empty($technicalTrainee)) {
            foreach ($this->form as $key => $data) {
                if ($key !== 'documents') {
                    $this->form[$key] = $technicalTrainee[$key];
                }
            }
            foreach ($technicalTrainee->documents as $document) {
                $this->form['documents'][] = [
                    'id' => $document->id,
                    'title' => $document->title,
                ];
            }
        }
    }

    public function rules(): array
    {
        if (empty($this->technicalTrainee)) {
            $this->validationRules = array_merge($this->validationRules, [
                'form.photo' => ['required', 'image', 'max:300'],
                'form.nomination_letter' => ['required', 'mimes:pdf,jpg,jpeg,png'],
                'form.recommendation_letter' => ['required', 'mimes:pdf,jpg,jpeg,png'],
                'form.documents.*.title' => ['required_with:form.documents', 'string'],
                'form.documents.*.document' => ['required_with:form.documents', 'file'],
            ]);
        } else {
            $this->validationRules = array_merge($this->validationRules, [
                'form.photo' => ['nullable', 'image', 'max:300'],
                'form.nomination_letter' => ['nullable', 'mimes:pdf,jpg,jpeg,png'],
                'form.recommendation_letter' => ['nullable', 'mimes:pdf,jpg,jpeg,png'],
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

    public function documentsArrayIncrement()
    {
        $this->form['documents'][] = [];
    }

    public function documentsArrayDecrement($index)
    {
        if (array_key_exists('id', $this->form['documents'][$index])) {
            $this->deleteConfirm($index, 'deleteTraineeTrainings');
        } else {
            $this->removeDocuments($index);
        }
    }

    public function save()
    {
        $data = $this->validate()['form'];

        DB::transaction(function () use ($data) {
            if (!empty($this->technicalTrainee)) {
                $technicalTrainee = $this->technicalTrainee;
                $technicalTrainee->update($data);
                foreach ($this->form['documents'] as $document) {
                    if (array_key_exists('id', $document)) {
                        Document::find($document['id'])->update($document);
                    } else {
                        $technicalTrainee->documents()->create($document);
                    }
                }

                $this->dispatchBrowserEvent('alert_message', [
                    'type' => 'success',
                    'title' => 'Thank You',
                    'text' => 'Trainee Details Updated Successfully',
                ]);

                return redirect(route('admin.roaster.training.show', $technicalTrainee->trainingTrainee->training_id));
            } else {
                $technicalTrainee = TechnicalTrainee::create($data);
                $technicalTrainee->trainingTrainee()->create([
                    'training_id' => $this->training->id,
                ]);
                foreach ($data['documents'] as $document) {
                    $technicalTrainee->documents()->create($document);
                }
                $this->reset('form');
                $this->dispatchBrowserEvent('alert_message', [
                    'type' => 'success',
                    'title' => 'Thank You',
                    'text' => "तपाईंको फारम सफलतापूर्वक पेश गरियो र तपाईंको प्रशिक्षार्थी आईडी $technicalTrainee->reference_id हो। कृपया भविष्यमा प्रयोगको लागि आईडी सुरक्षित राख्नुहोस्।",
                ]);
            }
        });
    }

    protected $validationRules = [
        'form.employee_name' => ['required', 'string', 'max:255'],
        'form.designation_id' => ['required', 'exists:designations,id'],
        'form.department_id' => ['required', 'exists:departments,id'],
        'form.contact_no' => ['required', 'regex:/^([0-9,]*)$/'],
        'form.email' => ['nullable', 'email'],
        'form.education_qualification' => ['required', 'string', 'max:255'],
        'form.service_time' => ['nullable', 'string', 'max:255'],
        'form.province_id' => ['required', 'exists:provinces,id'],
        'form.district_id' => ['required', 'exists:districts,id'],
        'form.local_body_id' => ['required', 'exists:local_bodies,id'],
        'form.ward_no' => ['required', 'integer'],
        'form.tole' => ['nullable', 'string', 'max:255'],
        'form.office_name' => ['required', 'string', 'max:255'],
        'form.office_address' => ['required', 'string', 'max:255'],
        'form.office_phone' => ['required'],
        'form.office_email' => ['nullable', 'email'],
        'form.documents' => ['nullable', 'array'],
    ];

    protected $messages = [
        'form.employee_name.required' => 'पूरा नाम आवश्यक छ ।',
        'form.designation_id.required' => 'पद आवश्यक छ ।',
        'form.department_id.required' => 'सेवा समुह आवश्यक छ ।',
        'form.contact_no.required' => 'फोन नम्बर आवश्यक छ ।',
        'form.contact_no.regex' => 'फोन नम्बर 98XXXX,98XXXX ।',
        'form.education_qualification.required' => 'शैक्षिक योग्यता आवश्यक छ ।',
        'form.province_id.required' => 'प्रदेश आवश्यक छ ।',
        'form.district_id.required' => 'जिल्ला आवश्यक छ ।',
        'form.local_body_id.required' => 'स्थानीय निकाय आवश्यक छ ।',
        'form.ward_no.required' => 'वार्ड नम्बर आवश्यक छ ।',
        'form.tole.required' => 'टोल आवश्यक छ ।',
        'form.photo.required' => 'फोटो आवश्यक छ ।',
        'form.photo.max' => '300kb भन्दा कम मात्र ।',
        'form.office_name.required' => 'कार्यालयको नाम आवश्यक छ ।',
        'form.office_address.required' => 'कार्यालयको ठेगाना आवश्यक छ ।',
        'form.office_phone.required' => 'कार्यालयको फोन नम्बर आवश्यक छ ।',
        'form.nomination_letter.required' => 'मनोनयन पत्र आवश्यक छ ।',
        'form.nomination_letter.max' => '300kb भन्दा कम मात्र ।',
        'form.recommendation_letter.required' => 'सिफारिस आवश्यक छ ।',
        'form.recommendation_letter.max' => '300kb भन्दा कम मात्र ।',
        'form.documents.*.title.required_with' => 'कागजातको नाम आवश्यक छ ।',
        'form.documents.*.document.required_with' => 'फाइल आवश्यक छ ।',
    ];

    public function deleteConfirm($index)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Are Your Sure to Delete ?',
            'text' => 'If you delete this, it will be gone forever.',
            'index' => $index,
        ]);
    }

    public function removeDocuments($index)
    {
        unset($this->form['documents'][$index]);
        $this->form['documents'] = array_values($this->form['documents']);
    }

    public function render()
    {
        $this->getDependentAddressData();

        return view('roaster::livewire.technical-trainee-livewire');
    }
}

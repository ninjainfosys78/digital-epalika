<?php

namespace Modules\JudicialCommittee\Http\Livewire;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\JudicialCommittee\Entities\ComplainantDefendant;
use Modules\JudicialCommittee\Entities\ComplaintApplication;
use Modules\JudicialCommittee\Entities\ComplaintSubject;
use Modules\JudicialCommittee\Entities\RelatedMember;
use Modules\JudicialCommittee\Entities\Witness;
use Modules\JudicialCommittee\Enums\ComplainantDefendantTypeEnum;
use Modules\JudicialCommittee\Enums\ComplaintApplicationStatusEnum;
use Modules\JudicialCommittee\Events\ComplaintLogEvent;

class ComplainRegistrationLivewire extends Component
{
    use WithFileUploads;

    public $provinces = [];
    public $lawsuitNatures = [];
    public $complaintSubjects = [];

    public ComplaintApplication $compliantRegistration;

    public array $form = [
        'complainants' => [],
        'defendants' => [],
        'lawsuit_nature_id' => null,
        'complaint_subject_id' => null,
        'complaint_detail' => null,
        'date' => null,
        'en_date' => null,
        'applicant_name' => null,
        'applicant_phone' => null,
        'applicant_address' => null,
        'applicant_signature' => null,
        'relatedMembers' => [],
        'witnesses' => [],
        'supportedDocuments' => [],
        'complain_type' => []
    ];
    public function mount($compliantRegistration = null)
    {
        $this->provinces = get_provinces();
        $this->complaintSubjects = ComplaintSubject::all();

        if (!empty($compliantRegistration)) {
            $this->assignComplaintApplicationData($compliantRegistration);
        } else {
            $this->addComplainants();
            $this->addDefendants();
        }
    }

    protected $listeners = ['dateChanged'];

    public function dateChanged($nepaliDate, $englishDate)
    {
        $this->form['date'] = $nepaliDate;
        $this->form['en_date'] = $englishDate;
    }

    protected $rules = [
        'form.complainants.*.complain_type' => ['required'],
        'form.complainants.*.name' => ['required', 'string', 'max:255'],
        'form.complainants.*.age' => ['nullable', 'integer'],
        'form.complainants.*.father_name' => ['nullable', 'string', 'max:255'],
        'form.complainants.*.grandfather_name' => ['nullable', 'string', 'max:255'],
        'form.complainants.*.spouse_name' => ['nullable', 'string', 'max:255'],
        'form.complainants.*.province_id' => ['required', 'exists:provinces,id'],
        'form.complainants.*.district_id' => ['required', 'exists:districts,id'],
        'form.complainants.*.local_body_id' => ['required', 'exists:local_bodies,id'],
        'form.complainants.*.ward_no' => ['required', 'integer'],
        'form.complainants.*.tole' => ['nullable'],
        'form.defendants.*.complain_type' => ['required'],
        'form.defendants.*.name' => ['required', 'string', 'max:255'],
        'form.defendants.*.age' => ['nullable', 'integer'],
        'form.defendants.*.father_name' => ['nullable', 'string', 'max:255'],
        'form.defendants.*.grandfather_name' => ['nullable', 'string', 'max:255'],
        'form.defendants.*.spouse_name' => ['nullable', 'string', 'max:255'],
        'form.defendants.*.province_id' => ['nullable', 'exists:provinces,id'],
        'form.defendants.*.district_id' => ['nullable', 'exists:districts,id'],
        'form.defendants.*.local_body_id' => ['nullable', 'exists:local_bodies,id'],
        'form.defendants.*.ward_no' => ['nullable', 'integer'],
        'form.defendants.*.tole' => ['nullable'],
        'form.lawsuit_nature_id' => ['nullable', 'exists:lawsuit_natures,id'],
        'form.complaint_subject_id' => ['required', 'exists:complaint_subjects,id'],
        'form.complaint_detail' => ['required'],
        'form.date' => ['required'],
        'form.en_date' => ['required'],
        'form.applicant_name' => ['required', 'string', 'max:255'],
        'form.applicant_phone' => ['required'],
        'form.applicant_address' => ['nullable'],
        'form.applicant_signature' => ['nullable', 'image'],
        'form.relatedMembers' => ['nullable', 'array'],
        'form.relatedMembers.*.name' => ['nullable'],
        'form.relatedMembers.*.phone' => ['nullable'],
        'form.relatedMembers.*.email' => ['nullable', 'email'],
        'form.relatedMembers.*.designation' => ['nullable'],
        'form.relatedMembers.*.address' => ['nullable'],
        'form.witnesses' => ['nullable', 'array'],
        'form.witnesses.*.name' => ['nullable', 'string', 'max:255'],
        'form.witnesses.*.age' => ['nullable', 'integer'],
        'form.witnesses.*.phone' => ['nullable'],
        'form.witnesses.*.address' => ['nullable'],
        'form.supportedDocuments' => ['nullable', 'array'],
        'form.supportedDocuments.*.document_name' => ['nullable', 'string', 'max:255'],
        'form.supportedDocuments.*.document' => ['nullable', 'mimes:jpg,jpeg,png,pdf']
    ];

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function addComplainants()
    {
        $this->form['complainants'][] = [
            'province_id' => \officeSetting()->province_id,
            'district_id' => \officeSetting()->district_id,
            'local_body_id' => \officeSetting()->local_body_id,
        ];
    }

    public function removeComplainant($index)
    {
        if (!empty($this->form['complainants'][$index]['id'])) {
            ComplainantDefendant::find($this->form['complainants'][$index]['id'])->delete();
        }
        unset($this->form['complainants'][$index]);
        $this->form['complainants'] = array_values($this->form['complainants']);
    }

    public function addDefendants()
    {
        $this->form['defendants'][] = [
            'province_id' => \officeSetting()->province_id,
            'district_id' => \officeSetting()->district_id,
            'local_body_id' => \officeSetting()->local_body_id,
        ];
    }

    public function removeDefendant($index)
    {
        if (!empty($this->form['defendants'][$index]['id'])) {
            ComplainantDefendant::find($this->form['defendants'][$index]['id'])->delete();
        }
        unset($this->form['defendants'][$index]);
        $this->form['defendants'] = array_values($this->form['defendants']);
    }

    public function addWitnesses()
    {
        $this->form['witnesses'][] = [];
    }

    public function removeWitness($index)
    {
        if (!empty($this->form['witnesses'][$index]['id'])) {
            Witness::find($this->form['witnesses'][$index]['id'])->delete();
        }
        unset($this->form['witnesses'][$index]);
        $this->form['witnesses'] = array_values($this->form['witnesses']);
    }

    public function addSupportedDocuments()
    {
        $this->form['supportedDocuments'][] = [];
    }

    public function removeSupportedDocument($index)
    {
        unset($this->form['supportedDocuments'][$index]);
        $this->form['supportedDocuments'] = array_values($this->form['supportedDocuments']);
    }

    public function addRelatedMembers()
    {
        $this->form['relatedMembers'][] = [];
    }

    public function removeRelatedMember($index)
    {
        if (!empty($this->form['relatedMembers'][$index]['id'])) {
            RelatedMember::find($this->form['relatedMembers'][$index]['id'])->delete();
        }
        unset($this->form['relatedMembers'][$index]);
        $this->form['relatedMembers'] = array_values($this->form['relatedMembers']);
    }

    public function submitFormData()
    {
        $formData = $this->validate()['form'];

        DB::transaction(function () use ($formData) {
            if (!empty($this->compliantRegistration)) {
                $compliantRegistration = $this->compliantRegistration;
                $compliantRegistration->update($formData + [
                    'subject' => ComplaintSubject::find($this->form['complaint_subject_id'])->subject ?? null
                ]);
            } else {
                $compliantRegistration = ComplaintApplication::create($this->validate()['form'] + [
                    'fiscal_year_id' => \officeSetting()->fiscal_year_id,
                    'submission_no' => \officeSetting()->fiscalYear->title . '-' . Str::padLeft(ComplaintApplication::max('id') + 1, 4, 0),
                    'subject' => ComplaintSubject::find($this->form['complaint_subject_id'])->subject ?? null,
                    'application_status' => ComplaintApplicationStatusEnum::PENDING
                ]);
                //complaint log event
                event(new ComplaintLogEvent($compliantRegistration->id, ComplaintApplication::class, $compliantRegistration->id, 'निवेदन दर्ता', "$compliantRegistration->date गते निवेदन दर्ता गरियो"));
            }
            foreach ($this->form['complainants'] as $complainant) {
                ComplainantDefendant::updateOrCreate(
                    ['complaint_application_id' => $compliantRegistration->id, 'id' => $complainant['id'] ?? null],
                    $complainant + [
                        'type' => ComplainantDefendantTypeEnum::COMPLAINANT,

                    ]
                );
            }
            foreach ($this->form['defendants'] as $defendant) {
                ComplainantDefendant::updateOrCreate(
                    ['complaint_application_id' => $compliantRegistration->id, 'id' => $defendant['id'] ?? null],
                    $defendant + [
                        'type' => ComplainantDefendantTypeEnum::DEFENDANT,


                    ]
                );
            }

            foreach ($this->form['witnesses'] as $witness) {
                Witness::updateOrCreate(
                    ['complaint_application_id' => $compliantRegistration->id, 'type' => ComplainantDefendantTypeEnum::COMPLAINANT, 'id' => $witness['id'] ?? null],
                    $witness
                );
            }


            foreach ($this->form['supportedDocuments'] as $supportedDocument) {
                $compliantRegistration->supportedDocuments()->updateOrCreate([
                    'type' => ComplainantDefendantTypeEnum::COMPLAINANT,
                    'document_name' => $supportedDocument['document_name'],
                    'document' => $supportedDocument['document']
                ]);
            }
        });


        $this->reset('form');
        $this->dispatchBrowserEvent('toast_message', [
            'type' => 'success',
            'title' => 'उजुरी पत्र सफलतापूर्वक थपियो'
        ]);
        $this->addComplainants();
        $this->addDefendants();
        $this->dispatchBrowserEvent('alert_message', [
            'type' => 'success',
            'title' => 'धन्यबाद',
            'text' => 'उजुरी पत्र सफलतापूर्वक थपियो ',
        ]);
    }

    private function assignComplaintApplicationData($compliantRegistration)
    {
        $this->compliantRegistration = $compliantRegistration;

        foreach (Arr::except($this->form, ['relatedMembers', 'witnesses', 'complaintDefendants', 'applicant_signature', 'supportedDocuments']) as $key => $data) {
            $this->form[$key] = $compliantRegistration[$key];
        }

        foreach ($compliantRegistration->complainantDefendants->where('type', ComplainantDefendantTypeEnum::COMPLAINANT) as $complainant) {
            $this->form['complainants'][] = [
                'id' => $complainant->id,
                'name' => $complainant->name ?? null,
                'complain_type' => $complainant->complain_type ?? null,
                'age' => $complainant->age ?? null,
                'father_name' => $complainant->father_name ?? null,
                'grandfather_name' => $complainant->grandfather_name ?? null,
                'spouse_name' => $complainant->spouse_name ?? null,
                'province_id' => $complainant->province_id ?? null,
                'district_id' => $complainant->district_id ?? null,
                'local_body_id' => $complainant->local_body_id ?? null,
                'ward_no' => $complainant->ward_no ?? null,
                'tole' => $complainant->tole ?? null
            ];
        }

        foreach ($compliantRegistration->complainantDefendants->where('type', ComplainantDefendantTypeEnum::DEFENDANT) as $defendant) {
            $this->form['defendants'][] = [
                'id' => $defendant->id,
                'complain_type' => $defendant->complain_type ?? null,
                'name' => $defendant->name ?? null,
                'age' => $defendant->age ?? null,
                'father_name' => $defendant->father_name ?? null,
                'grandfather_name' => $defendant->grandfather_name ?? null,
                'spouse_name' => $defendant->spouse_name ?? null,
                'province_id' => $defendant->province_id ?? null,
                'district_id' => $defendant->district_id ?? null,
                'local_body_id' => $defendant->local_body_id ?? null,
                'ward_no' => $defendant->ward_no ?? null,
                'tole' => $defendant->tole ?? null
            ];
        }

        foreach ($compliantRegistration->witnesses->where('type', ComplainantDefendantTypeEnum::COMPLAINANT) as $witness) {
            $this->form['witnesses'][] = [
                'id' => $witness->id,
                'name' => $witness->name ?? null,
                'age' => $witness->age ?? null,
                'phone' => $witness->phone ?? null,
                'address' => $witness->address ?? null,
            ];
        }

        foreach ($compliantRegistration->relatedMembers as $member) {
            $this->form['relatedMembers'][] = [
                'id' => $member->id ?? null,
                'name' => $member->name ?? null,
                'phone' => $member->phone ?? null,
                'email' => $member->email ?? null,
                'designation' => $member->designation ?? null,
                'address' => $member->address ?? null
            ];
        }
    }

    public function render()
    {
        if (!empty($this->form['lawsuit_nature_id'])) {
            $this->complaintSubjects = ComplaintSubject::where('lawsuit_nature_id', $this->form['lawsuit_nature_id'])->get();
        }

        return view('judicialcommittee::livewire.complain-registration-livewire');
    }

    public function messages(): array
    {
        return [
            'form.complainants.*.complain_type.required' => 'वादीको प्रकार अनिवार्य छ',
            'form.complainants.*.name.required' => 'नाम अनिवार्य छ',
            'form.complainants.*.province_id.required' => 'प्रदेश अनिवार्य छ',
            'form.complainants.*.district_id.required' => 'जिल्ला अनिवार्य छ',
            'form.complainants.*.local_body_id.required' => 'स्थानीय तह अनिवार्य छ',
            'form.complainants.*.ward_no.required' => 'वार्ड नं अनिवार्य छ',
            'form.defendants.*.complain_type.required' => 'प्रतिवादीको प्रकार अनिवार्य छ',
            'form.defendants.*.name.required' => 'नाम अनिवार्य छ',
            'form.defendants.*.province_id.required' => 'प्रदेश अनिवार्य छ',
            'form.defendants.*.district_id.required' => 'जिल्ला अनिवार्य छ',
            'form.defendants.*.local_body_id.required' => 'स्थानीय तह अनिवार्य छ',
            'form.defendants.*.ward_no.required' => 'वार्ड नं अनिवार्य छ',
            'form.lawsuit_nature_id' => 'मुद्दा प्रकृति अनिवार्य छ',
            'form.complaint_subject_id.required' => 'विषय अनिवार्य छ',
            'form.complaint_detail.required' => 'उजुरी विवरण अनिवार्य छ',
            'form.date.required' => 'मिति अनिवार्य छ',
            'form.en_date.required' => 'मिति अनिवार्य छ',
            'form.applicant_name.required' => 'आवेदकको नाम अनिवार्य छ',
            'form.applicant_phone.required' => 'आवेदकको फोन अनिवार्य छ',
            'form.relatedMembers.*.name.required' => ['नाम अनिवार्य छ'],
            'form.relatedMembers.*.phone.required' => ['फोन अनिवार्य छ'],
            'form.relatedMembers.*.email.email' => ['ईमेल मान्य छैन'],
            'form.relatedMembers.*.designation.required' => ['पद आवश्यक छ'],
            'form.witnesses.*.name.required' => 'नाम अनिवार्य छ',
            'form.supportedDocuments.*.document_name.required' => 'फाइलको नाम अनिवार्य छ',
            'form.supportedDocuments.*.document.required' => 'फाइल अनिवार्य छ',
        ];
    }
}

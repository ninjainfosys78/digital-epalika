<?php

namespace Modules\EMap\Http\Livewire\Edit;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\EMap\Entities\DesignerDetail;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Enums\PostsEnum;

class DesignerDetailEditLivewire extends Component
{
    public MapApply $mapApply;

    public array $designerDetails = [];

    public ?int $dataToEdit = null;

    public function mount(MapApply $mapApply): void
    {
        $this->mapApply = $mapApply;
        $availablePost = collect();
        $mapApply->load('designerDetails');
        foreach ($mapApply->designerDetails as $designerDetail) {
            $this->designerDetails[] = [
                'id' => $designerDetail->id ?? '',
                'post' => $designerDetail->post->value,
                'name' => $designerDetail->name ?? null,
                'father_name' => $designerDetail->father_name ?? null,
                'grandfather_name' => $designerDetail->grandfather_name ?? null,
                'phone' => $designerDetail->phone ?? null,
                'address' => $designerDetail->address ?? null,
                'local_body' => $designerDetail->local_body ?? null,
                'ward_no' => $designerDetail->ward_no ?? null,
                'nec_council_no' => $designerDetail->nec_council_no ?? null,
                'local_body_registration_no' => $designerDetail->local_body_registration_no ?? null,
                'consulting_firm_name' => $designerDetail->consulting_firm_name ?? null,
            ];
            $availablePost->push($designerDetail->post->value);
        }

        foreach (PostsEnum::cases() as $postsEnum) {
            if (!$availablePost->unique()->contains($postsEnum->value)) {
                $this->designerDetails[] = [
                    'post' => $postsEnum->value,
                    'name' => null,
                    'father_name' => null,
                    'grandfather_name' => null,
                    'phone' => null,
                    'address' => null,
                    'local_body' => null,
                    'ward_no' => null,
                    'nec_council_no' => null,
                    'local_body_registration_no' => null,
                    'consulting_firm_name' => null,
                ];
            }
        }
    }

    public function rules(): array
    {
        if ($this->dataToEdit === null) {
            return [];
        }

        return [
            'designerDetails' => ['required', 'array'],
            'designerDetails.'.$this->dataToEdit.'.name' => ['required'],
            'designerDetails.'.$this->dataToEdit.'.father_name' => ['required'],
            'designerDetails.'.$this->dataToEdit.'.grandfather_name' => ['required'],
            'designerDetails.'.$this->dataToEdit.'.phone' => ['required'],
            'designerDetails.'.$this->dataToEdit.'.address' => ['required'],
            'designerDetails.'.$this->dataToEdit.'.local_body' => ['required'],
            'designerDetails.'.$this->dataToEdit.'.ward_no' => ['required', 'integer'],
            'designerDetails.'.$this->dataToEdit.'.post' => ['required'],
            'designerDetails.'.$this->dataToEdit.'.nec_council_no' => ['nullable'],
            'designerDetails.'.$this->dataToEdit.'.local_body_registration_no' => ['nullable'],
            //'designerDetails.'.$this->dataToEdit.'.consulting_firm_name' => ['required'],
        ];
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function setDataForEdit(?int $index = null): void
    {
        $this->dataToEdit = $index;
    }

    public function saveFormData()
    {
        if ($this->dataToEdit !== null) {
            $this->validate();
            DB::transaction(function () {
                $dataToSave = $this->designerDetails[$this->dataToEdit];

                if (!empty($dataToSave['id'])) {
                    DesignerDetail::find($dataToSave['id'])?->update($dataToSave);
                } else {
                    DesignerDetail::create($dataToSave + ['map_apply_id' => $this->mapApply->id]);
                }
            });

            $this->reset('dataToEdit');

            $this->dispatchBrowserEvent('toast_message', [
                'type' => 'success',
                'title' => 'फारम सफलतापूर्वक सम्पादन गरियो'
            ]);
        }
    }

    public function messages(): array
    {
        return [
            'designerDetails.required' => 'डिजाइनरको विवरण अनिवार्य छ|',
            'designerDetails.*.name.required' => ' नाम अनिवार्य छ|',
            'designerDetails.*.father_name.required' => 'बुबाको नाम अनिवार्य छ|',
            'designerDetails.*.grand_father_name.required' => 'हजुरबुबाको नाम अनिवार्य छ|',
            'designerDetails.*.phone.required' => ' फोन अनिवार्य छ|',
            'designerDetails.*.address.required' => ' ठेगाना अनिवार्य छ|',
            'designerDetails.*.local_body.required' => ' पालिका  अनिवार्य छ|',
            'designerDetails.*.ward_no.required' => ' वडा नं.   अनिवार्य छ|',
            'designerDetails.*.post.required' => 'पद अनिवार्य छ|',
            'designerDetails.*.nec_council_no.required' => 'NEC Council No. अनिवार्य छ|',
            'designerDetails.*.local_body_registration_no.required' => 'पालिकाको दर्ता नं अनिवार्य छ|',
            'designerDetails.*.consulting_firm_name.required' => 'कन्सल्टिंग फर्म नाम अनिवार्य छ|',
            'criteriaDetails.required' => 'मापदण्ड विवरण अनिवार्य छ|',
            'criteriaDetails.*.according_to_criteria.required' => 'मापदण्ड अनुसार अनिवार्य छ|',
            'criteriaDetails.*.according_to_map.required' => 'नक्सा अनुसार अनिवार्य छ|',
            'criteriaDetails.*.compliance.required' => 'अनुपालन अनिवार्य छ|',
            'buildingDetails.required' => 'भवन सम्बन्धि विवरण अनिवार्य छ|',
            'buildingDetails.*.description.required' => 'विवरण अनिवार्य छ|',
        ];
    }

    public function render()
    {
        return view('emap::livewire.edit.designer-detail-edit-livewire');
    }
}

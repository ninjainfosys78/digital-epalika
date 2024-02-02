<?php

namespace Modules\EMap\Http\Livewire\Edit;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\EMap\Entities\MapApply;

class ConsultancyDetailEditLiveware extends Component
{
    use WithFileUploads;

    public MapApply $mapApply;

    public bool $editForm = false;

    public $signatureUrl;

    public array $applyMap = [
        'consultant_name' => null,
        'consultant_mobile_no' => null,
        'consultant_nec_no' => null,
    ];

    public function mount(MapApply $mapApply): void
    {
        $this->mapApply = $mapApply;

        $this->applyMap = [
            'consultant_signature' => null,
            'consultant_name' => $mapApply->consultant_name ?? null,
            'consultant_mobile_no' => $mapApply->consultant_mobile_no ?? null,
            'consultant_nec_no' => $mapApply->consultant_nec_no ?? null,
        ];
        $this->signatureUrl = $mapApply->consultant_signature_url ?? null;
    }

    public function setEditForm(): void
    {
        $this->editForm = !$this->editForm;
    }

    protected array $applyMapValidations = [
        'applyMap.consultant_signature' => ['nullable', 'image'],
        'applyMap.consultant_name' => ['required'],
        'applyMap.consultant_mobile_no' => ['required'],
        'applyMap.consultant_nec_no' => ['required'],
    ];

    public function rules(): array
    {
        return $this->applyMapValidations;
    }

    public function saveFormData(): void
    {
        if ($this->editForm) {
            $this->validate();
            DB::transaction(function () {
                $this->mapApply->update($this->applyMap);
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
            'applyMap.consultant_signature.required' => 'इंन्जिनियरको सहि अनिवार्य छ|',
            'applyMap.consultant_signature.image' => 'सहिको फोटो हुनुपर्छ |',
            'applyMap.consultant_name.required' => 'नाम अनिवार्य छ|',
            'applyMap.consultant_mobile_no.required' => ' मोबाइल नं. अनिवार्य छ|',
            'applyMap.consultant_nec_no.required' => ' एन. ई. सी. नं अनिवार्य छ|',
        ];
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('emap::livewire.edit.consultancy-detail-edit-liveware');
    }
}

<?php

namespace Modules\Revenue\Http\Livewire;

use Livewire\Component;
use Modules\Revenue\Entities\PhysicalStructureType;
use Modules\Revenue\Entities\Sector;
use Modules\Revenue\Entities\StructureAssessmentRate;

class StructureAssessmentRateLivewire extends Component
{
    public $sectors = [];
    public $physicalStructureTypes = [];

    public StructureAssessmentRate $structureAssessmentRateUpdate;
    public $structureAssessmentRate = [
        'sector_id' => null,
        'physical_structure_type_id' => null,
        'usage' => null,
        'rate' => 0,
    ];

    public function mount($structureAssessmentRate = null)
    {
        $this->sectors = Sector::all();
        $this->physicalStructureTypes = PhysicalStructureType::all();
        if ($structureAssessmentRate) {
            $this->structureAssessmentRateUpdate = $structureAssessmentRate;
            $this->structureAssessmentRate = [
                'sector_id' => $structureAssessmentRate->sector_id,
                'physical_structure_type_id' => $structureAssessmentRate->physical_structure_type_id,
                'usage' => $structureAssessmentRate->usage,
                'rate' => $structureAssessmentRate->rate,
            ];
        }
    }

    protected $rules = [
        'structureAssessmentRate.sector_id' => ['required', 'exists:sectors,id,deleted_at,NULL'],
        'structureAssessmentRate.physical_structure_type_id' => ['required', 'exists:physical_structure_types,id,deleted_at,NULL'],
        'structureAssessmentRate.usage' => ['required', 'string', 'max:255'],
        'structureAssessmentRate.rate' => ['required', 'numeric', 'min:0'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        if (!empty($this->structureAssessmentRateUpdate)) {
            $this->structureAssessmentRateUpdate->update($this->structureAssessmentRate);
            $message = 'Structure Assessment Rate Updated Successfully';
        } else {
            StructureAssessmentRate::create(array_merge($this->structureAssessmentRate, ['user_id' => auth()->id()]));
            $message = 'Structure Assessment Rate Created Successfully';
        }

        $this->reset('structureAssessmentRate');
        toast($message, 'success');
        return redirect()->route('admin.revenue.setting.structureAssessmentRate.index');
    }

    public function render()
    {
        return view('revenue::livewire.structure-assessment-rate-livewire');
    }
}

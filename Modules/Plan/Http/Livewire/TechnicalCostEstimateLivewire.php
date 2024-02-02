<?php

namespace Modules\Plan\Http\Livewire;

use App\Models\Settings\Units\Unit;
use Illuminate\Support\Collection;
use Livewire\Component;
use Modules\Plan\Entities\Project;
use Modules\Plan\Entities\TechnicalCostEstimate;

class TechnicalCostEstimateLivewire extends Component
{
    public Project $project;

    public array $technicalCostEstimates = [];
    public Collection $units;

    public function mount(Project $project)
    {
        $this->units = Unit::orderBy('position')->get();
        $this->assignTechnicalCostEstimateData($project);
    }

    public function addTechnicalCostEstimates()
    {
        $this->technicalCostEstimates[] = [];
    }

    public function removeTechnicalCostEstimate($index)
    {
        if (!empty($this->technicalCostEstimates[$index]['id'])) {
            TechnicalCostEstimate::find($this->technicalCostEstimates[$index]['id'])->delete();
        }
        unset($this->technicalCostEstimates[$index]);
        $this->technicalCostEstimates = array_values($this->technicalCostEstimates);
    }

    private function assignTechnicalCostEstimateData($project)
    {
        $this->project = $project->load('technicalCostEstimates');

        foreach ($project->technicalCostEstimates as $technicalCostEstimate) {
            $this->technicalCostEstimates[] = [
                'id' => $technicalCostEstimate->id ?? null,
                'detail' => $technicalCostEstimate->detail ?? null,
                'quantity' => $technicalCostEstimate->quantity ?? 0,
                'unit_id' => $technicalCostEstimate->unit_id ?? null,
                'rate' => $technicalCostEstimate->rate ?? 0
            ];
        }
    }

    public function rules(): array
    {
        return [
            'technicalCostEstimates.*.detail' => ['required', 'string', 'max:255'],
            'technicalCostEstimates.*.quantity' => ['required', 'numeric'],
            'technicalCostEstimates.*.unit_id' => ['required', 'exists:units,id'],
            'technicalCostEstimates.*.rate' => ['required', 'numeric']
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitFormData()
    {
        $this->validate();

        foreach ($this->technicalCostEstimates as $technicalCostEstimate) {
            TechnicalCostEstimate::updateOrCreate(
                ['project_id' => $this->project->id, 'id' => $technicalCostEstimate['id'] ?? null],
                [
                    'detail' => !empty($technicalCostEstimate['detail']) ? $technicalCostEstimate['detail'] : null,
                    'number' => !empty($technicalCostEstimate['number']) ? $technicalCostEstimate['number'] : 0,
                    'length' => !empty($technicalCostEstimate['length']) ? $technicalCostEstimate['length'] : 0,
                    'breadth' => !empty($technicalCostEstimate['breadth']) ? $technicalCostEstimate['breadth'] : 0,
                    'height' => !empty($technicalCostEstimate['height']) ? $technicalCostEstimate['height'] : 0,
                    'quantity' => !empty($technicalCostEstimate['quantity']) ? $technicalCostEstimate['quantity'] : 0,
                    'unit_id' => !empty($technicalCostEstimate['unit_id']) ? $technicalCostEstimate['unit_id'] : null,
                    'rate' => !empty($technicalCostEstimate['rate']) ? $technicalCostEstimate['rate'] : 0
                ]
            );
        }

        $this->reset('technicalCostEstimates');
        $this->assignTechnicalCostEstimateData($this->project);

        $this->dispatchBrowserEvent('toast_message', [
            'type' => 'success',
            'title' => 'प्राविधिक लागत अनुमान सफलतापूर्वक पेश गरियो',
        ]);
    }

    public function messages(): array
    {
        return [
            'technicalCostEstimates.*.detail.required' => 'विवरण आवश्यक छ',
            'technicalCostEstimates.*.quantity.required' => 'परिमाण आवश्यक छ',
            'technicalCostEstimates.*.unit_id.required' => 'इकाई आवश्यक छ',
            'technicalCostEstimates.*.rate.required' => 'दर आवश्यक छ'
        ];
    }

    public function render()
    {
        return view('plan::livewire.technical-cost-estimate-livewire');
    }
}

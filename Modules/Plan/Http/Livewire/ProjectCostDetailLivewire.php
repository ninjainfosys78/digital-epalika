<?php

namespace Modules\Plan\Http\Livewire;

use Illuminate\Validation\Rules\Enum;
use Livewire\Component;
use Modules\Plan\Entities\BenefitedMemberDetail;
use Modules\Plan\Entities\Project;
use Modules\Plan\Entities\ProjectGrantDetail;
use Modules\Plan\Enums\GrantSourceEnum;

class ProjectCostDetailLivewire extends Component
{
    public array $form = [
        'benefited_organization' => 0,
        'others_benefited' => 0,
        'projectGrantDetails' => [],
        'benefitedMemberDetails' => [],
        'progress_spent_amount' => 0,
        'physical_progress_target' => 0,
        'physical_progress_completed' => 0,
        'physical_progress_unit' => '',
        'office_grant' => 0,
        'agencies_grants' => 0,
        'share_amount' => 0,
        'committee_share_amount' => 0,
        'total_amount_for_contingency' => 0,
        'contingency_percent' => 0,
        'contingency_amount' => 0,
        'other_taxes' => 0,
        'project_contract_amount' => 0,
        'labor_amount' => 0,
        'total_cost_estimate_amount' => 0
    ];

    public Project $project;

    public function mount($project_id = null)
    {
        if (!empty($project_id)) {
            $this->assignProjectData($project_id);
        }
    }

    public function rules(): array
    {
        return [
            'form.benefited_organization' => ['required', 'numeric'],
            'form.others_benefited' => ['required', 'numeric'],
            'form.progress_spent_amount' => ['nullable', 'numeric'],
            'form.physical_progress_target' => ['nullable', 'numeric'],
            'form.physical_progress_completed' => ['nullable', 'numeric'],
            'form.physical_progress_unit' => ['nullable'],
            'form.agencies_grants' => ['nullable', 'numeric'],
            'form.share_amount' => ['nullable', 'numeric'],
            'form.committee_share_amount' => ['nullable', 'numeric'],
            'form.contingency_amount' => ['nullable', 'numeric'],
            'form.other_taxes' => ['nullable', 'numeric'],
            'form.labor_amount' => ['nullable', 'numeric'],
            'form.projectGrantDetails.*' => ['nullable', 'array'],
            'form.projectGrantDetails.*.grant_source' => ['required', new Enum(GrantSourceEnum::class)],
            'form.projectGrantDetails.*.asset_name' => ['required'],
            'form.projectGrantDetails.*.quantity' => ['required', 'numeric'],
            'form.projectGrantDetails.*.asset_unit' => ['required'],
            'form.benefitedMemberDetails.*.ward_no' => ['required', 'integer'],
            'form.benefitedMemberDetails.*.village' => ['required'],
            'form.benefitedMemberDetails.*.dalit_backward_no' => ['required', 'integer'],
            'form.benefitedMemberDetails.*.other_households_no' => ['required', 'integer'],
            'form.benefitedMemberDetails.*.no_of_male' => ['required', 'integer'],
            'form.benefitedMemberDetails.*.no_of_female' => ['required', 'integer']
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addProjectGrantDetails()
    {
        $this->form['projectGrantDetails'][] = [];
    }

    public function removeProjectGrantDetails($index)
    {
        if (!empty($this->form['projectGrantDetails'][$index]['id'])) {
            ProjectGrantDetail::find($this->form['projectGrantDetails'][$index]['id'])->delete();
        }
        unset($this->form['projectGrantDetails'][$index]);
        $this->form['projectGrantDetails'] = array_values($this->form['projectGrantDetails']);
    }

    public function addBenefitedMemberDetails()
    {
        $this->form['benefitedMemberDetails'][] = [];
    }

    public function removeBenefitedMemberDetails($index)
    {
        if (!empty($this->form['benefitedMemberDetails'][$index]['id'])) {
            BenefitedMemberDetail::find($this->form['benefitedMemberDetails'][$index]['id'])->delete();
        }
        unset($this->form['benefitedMemberDetails'][$index]);
        $this->form['benefitedMemberDetails'] = array_values($this->form['benefitedMemberDetails']);
    }

    private function assignProjectData($project_id)
    {
        $project = Project::withSum('projectAllocatedAmounts', 'amount')->with('projectGrantDetails', 'benefitedMemberDetails')->find($project_id);

        $this->project = $project;

        $this->form['office_grant'] = $project->project_allocated_amounts_sum_amount ?? 0;
        $this->form['agencies_grants'] = $project->agencies_grants ?? 0;
        $this->form['share_amount'] = $project->share_amount ?? 0;
        $this->form['committee_share_amount'] = $project->committee_share_amount ?? 0;
        $this->form['contingency_amount'] = $project->contingency_amount ?? 0;
        $this->form['contingency_percent'] = $this->totalAmountForContingency() > 0 ? round($project->contingency_amount * 100 / $this->totalAmountForContingency(), 2) : 0;
        $this->form['other_taxes'] = $project->other_taxes ?? 0;
        $this->form['labor_amount'] = $project->labor_amount ?? 0;
        $this->form['benefited_organization'] = $project->benefited_organization ?? 0;
        $this->form['others_benefited'] = $project->others_benefited ?? 0;
        $this->form['progress_spent_amount'] = $project->progress_spent_amount ?? 0;
        $this->form['physical_progress_target'] = $project->physical_progress_target ?? 0;
        $this->form['physical_progress_completed'] = $project->physical_progress_completed ?? 0;
        $this->form['physical_progress_unit'] = $project->physical_progress_unit ?? '';


        foreach ($project->projectGrantDetails as $projectGrantDetail) {
            $this->form['projectGrantDetails'][] = [
                'id' => $projectGrantDetail->id ?? null,
                'grant_source' => $projectGrantDetail->grant_source ?? null,
                'asset_name' => $projectGrantDetail->asset_name ?? null,
                'quantity' => $projectGrantDetail->quantity ?? 0,
                'asset_unit' => $projectGrantDetail->asset_unit ?? null,
            ];
        }
        foreach ($project->benefitedMemberDetails as $benefitedMemberDetail) {
            $this->form['benefitedMemberDetails'][] = [
                'id' => $benefitedMemberDetail->id ?? null,
                'ward_no' => $benefitedMemberDetail->ward_no ?? null,
                'village' => $benefitedMemberDetail->village ?? null,
                'dalit_backward_no' => $benefitedMemberDetail->dalit_backward_no ?? 0,
                'other_households_no' => $benefitedMemberDetail->other_households_no ?? 0,
                'no_of_male' => $benefitedMemberDetail->no_of_male ?? 0,
                'no_of_female' => $benefitedMemberDetail->no_of_female ?? 0,
                'no_of_others' => $benefitedMemberDetail->no_of_others ?? 0,
            ];
        }
    }

    public function submitFormData()
    {
        $formData = $this->validate()['form'];
        $this->project->update([
            'progress_spent_amount' => $formData['progress_spent_amount'] ?: 0,
            'physical_progress_target' => $formData['physical_progress_target'] ?: 0,
            'physical_progress_completed' => $formData['physical_progress_completed'] ?: 0,
            'physical_progress_unit' => $formData['physical_progress_unit'] ?? null,
            'agencies_grants' => $formData['agencies_grants'] ?: 0,
            'share_amount' => $formData['share_amount'] ?: 0,
            'committee_share_amount' => $formData['committee_share_amount'] ?: 0,
            'contingency_amount' => $formData['contingency_amount'] ?: 0,
            'other_taxes' => $formData['other_taxes'] ?: 0,
            'labor_amount' => $formData['labor_amount'] ?: 0,
            'benefited_organization' => $formData['benefited_organization'] ?: 0,
            'others_benefited' => $formData['others_benefited'] ?: 0
        ]);

        foreach ($this->form['projectGrantDetails'] as $projectGrantDetail) {
            ProjectGrantDetail::updateOrCreate(
                ['project_id' => $this->project->id, 'id' => $projectGrantDetail['id'] ?? null],
                $projectGrantDetail
            );
        }

        foreach ($this->form['benefitedMemberDetails'] as $benefitedMemberDetail) {
            BenefitedMemberDetail::updateOrCreate(
                ['project_id' => $this->project->id, 'id' => $benefitedMemberDetail['id'] ?? null],
                $benefitedMemberDetail
            );
        }

        $this->reset('form');
        $this->assignProjectData($this->project->id);

        $this->dispatchBrowserEvent('toast_message', [
            'type' => 'success',
            'title' => 'लागत विवरण सफलतापूर्वक अद्यावधिक गरियो',
        ]);
    }

    private function assignCalculatedAmount()
    {
        $this->form['total_amount_for_contingency'] = $this->totalAmountForContingency();
        $this->form['contingency_amount'] = ((float)$this->form['total_amount_for_contingency'] ?? 0) * ((float)$this->form['contingency_percent'] ?? 0) / 100;
        $this->form['project_contract_amount'] = ($this->form['total_amount_for_contingency'] ?? 0) - ($this->form['contingency_amount'] ?? 0) - ($this->form['other_taxes'] ?? 0);
        $this->form['total_cost_estimate_amount'] = ($this->form['project_contract_amount'] ?? 0) + ($this->form['labor_amount'] ?? 0);
    }

    private function totalAmountForContingency(): float|int
    {
        return ((float)$this->form['office_grant'] ?? 0) + ((float)$this->form['agencies_grants'] ?? 0) + ((float)$this->form['share_amount'] ?? 0) + ((float)$this->form['committee_share_amount'] ?? 0);
    }

    public function messages(): array
    {
        return [
            'form.benefitedMemberDetails.*.ward_no.required' => 'वडा नं. आबश्यक छ',
            'form.benefitedMemberDetails.*.village.required' => 'गाँउ बस्ति आबश्यक छ',
            'form.benefitedMemberDetails.*.dalit_backward_no.required' => 'दलित/पिछडिएका संख्या आबश्यक छ',
            'form.benefitedMemberDetails.*.other_households_no.required' => 'अन्य घरधुरी संख्या आबश्यक छ',
            'form.benefitedMemberDetails.*.no_of_female.required' => 'महिला संख्या आबश्यक छ',
            'form.benefitedMemberDetails.*.no_of_male.required' => 'पुरुष संख्या आबश्यक छ',
        ];
    }

    public function render()
    {
        $this->assignCalculatedAmount();

        return view('plan::livewire.project-cost-detail-livewire');
    }
}

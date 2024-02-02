<?php

namespace Modules\Plan\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Plan\Entities\Project;
use Modules\Plan\Entities\TechnicalCostEstimate;
use Modules\Plan\Http\Requests\TechnicalCostEstimate\StoreTechnicalCostEstimateRequest;
use Modules\Plan\Http\Requests\TechnicalCostEstimate\UpdateTechnicalCostEstimateRequest;

class TechnicalCostEstimateController extends Controller
{
    public function index(Project $project)
    {
        $this->checkAuthorization('technicalCostEstimate_access');



        return view('plan::admin.technical_cost_estimate.index', compact('project'));
    }

    public function create(Project $project)
    {
        $this->checkAuthorization('technicalCostEstimate_create');

        return view('plan::admin.technical_cost_estimate.create', compact('project'));
    }

    public function store(StoreTechnicalCostEstimateRequest $request, Project $project)
    {
        $this->checkAuthorization('technicalCostEstimate_create');

        $project->technicalCostEstimates()->create([
            'detail' => $request->input('detail'),
            'number' => $request->input('number') ?? 0,
            'length' => $request->input('length') ?? 0,
            'breadth' => $request->input('breadth') ?? 0,
            'height' => $request->input('height') ?? 0,
            'quantity' => $request->input('quantity') ?? 0,
            'unit' => $request->input('unit'),
            'rate' => $request->input('rate') ?? 0
        ]);

        toast('प्राविधिक लागत अनुमान सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function show(Project $project, TechnicalCostEstimate $technicalCostEstimate)
    {
        $this->checkAuthorization('technicalCostEstimate_access');

        return view('plan::show');
    }

    public function edit(Project $project, TechnicalCostEstimate $technicalCostEstimate)
    {
        $this->checkAuthorization('technicalCostEstimate_edit');

        return view('plan::admin.technical_cost_estimate.edit', compact('project', 'technicalCostEstimate'));
    }

    public function update(UpdateTechnicalCostEstimateRequest $request, Project $project, TechnicalCostEstimate $technicalCostEstimate)
    {
        $this->checkAuthorization('technicalCostEstimate_edit');

        $technicalCostEstimate->update([
            'detail' => $request->input('detail'),
            'number' => $request->input('number') ?? 0,
            'length' => $request->input('length') ?? 0,
            'breadth' => $request->input('breadth') ?? 0,
            'height' => $request->input('height') ?? 0,
            'quantity' => $request->input('quantity') ?? 0,
            'unit' => $request->input('unit'),
            'rate' => $request->input('rate') ?? 0
        ]);

        toast('प्राविधिक लागत अनुमान सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.plan.project.technicalCostEstimate.index', $project));
    }

    public function destroy(Project $project, TechnicalCostEstimate $technicalCostEstimate)
    {
        $this->checkAuthorization('technicalCostEstimate_delete');

        $technicalCostEstimate->delete();

        toast('प्राविधिक लागत अनुमान सफलतापूर्वक हटाइयो', 'success');
        return back();
    }
}

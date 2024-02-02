<?php

namespace Modules\Plan\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Modules\Plan\Entities\PlanTemplate;
use Modules\Plan\Http\Requests\Template\StorePlanTemplateRequest;
use Modules\Plan\Http\Requests\Template\UpdatePlanTemplateRequest;

class PlanTemplateController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('planTemplate_access');

        $planTemplates = PlanTemplate::all();

        return view('plan::admin.setting.template.index', compact('planTemplates'));
    }

    public function create()
    {
        $this->checkAuthorization('planTemplate_create');

        return view('plan::admin.setting.template.create');
    }

    public function store(StorePlanTemplateRequest $request)
    {
        $this->checkAuthorization('planTemplate_create');

        PlanTemplate::create($request->validated());

        Cache::forget('plan_templates');

        toast('टेम्प्लेट सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function show(Request $request, PlanTemplate $planTemplate)
    {
        $this->checkAuthorization('planTemplate_access');

        return view('plan::plan_template.show');
    }

    public function edit(PlanTemplate $planTemplate)
    {
        $this->checkAuthorization('planTemplate_edit');

        return view('plan::admin.setting.template.edit', compact('planTemplate'));
    }

    public function update(UpdatePlanTemplateRequest $request, PlanTemplate $planTemplate)
    {
        $this->checkAuthorization('planTemplate_edit');

        $planTemplate->update($request->validated());

        Cache::forget('plan_templates');

        toast('टेम्प्लेट सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.plan.planTemplate.index'));
    }

    public function destroy(PlanTemplate $planTemplate)
    {
        $this->checkAuthorization('planTemplate_delete');

        $planTemplate->delete();

        Cache::forget('plan_templates');

        toast('टेम्प्लेट सफलतापूर्वक मेटियो', 'success');

        return back();
    }
}

<?php

namespace Modules\Plan\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Plan\Entities\PlanArea;
use Modules\Plan\Http\Requests\PlanArea\StorePlanAreaRequest;
use Modules\Plan\Http\Requests\PlanArea\UpdatePlanAreaRequest;

class PlanAreaController extends Controller
{
    public function index($type)
    {
        $this->checkAuthorization('planArea_access');

        $planAreas = PlanArea::with('planArea')->where(function ($query) use ($type) {
            if ($type == 'planAreaSubCategory') {
                $query->whereNotNull('plan_area_id');
            } else {
                $query->whereNull('plan_area_id');
            }
        })->get();

        return view('plan::admin.setting.plan_area.index', compact('planAreas', 'type'));
    }

    public function planSubArea(Request $request, $type)
    {
        $this->checkAuthorization('planArea_access');

        $request->validate([
            'plan_area_id' => ['required']
        ]);

        return response()->json([
            'data' => PlanArea::filterData($request->all())->get()
        ]);
    }

    public function create($type)
    {
        $this->checkAuthorization('planArea_create');

        $mainPlanAreas = PlanArea::whereNull('plan_area_id')->get();

        return view('plan::admin.setting.plan_area.create', compact('mainPlanAreas', 'type'));
    }

    public function store(StorePlanAreaRequest $request, $type)
    {
        $this->checkAuthorization('planArea_create');

        PlanArea::create($request->validated());

        toast('योजना क्षेत्र सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function edit($type, PlanArea $planArea)
    {
        $this->checkAuthorization('planArea_edit');

        $mainPlanAreas = PlanArea::whereNull('plan_area_id')->get();

        return view('plan::admin.setting.plan_area.edit', compact('planArea', 'mainPlanAreas', 'type'));
    }

    public function update(UpdatePlanAreaRequest $request, $type, PlanArea $planArea)
    {
        $this->checkAuthorization('planArea_edit');

        $planArea->update($request->validated());

        toast('योजना क्षेत्र सफलतापूर्वक अपडेट गरियो', 'success');
        return redirect(route('admin.plan.planArea.index', $type));
    }

    public function destroy($type, PlanArea $planArea)
    {
        $this->checkAuthorization('planArea_delete');
        $planArea->planAreas()->delete();
        $planArea->delete();

        toast('योजना क्षेत्र सफलतापूर्वक मेटाइयो', 'success');

        return back();
    }
}

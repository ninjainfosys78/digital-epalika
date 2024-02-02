<?php

namespace Modules\Plan\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Plan\Entities\PlanLevel;
use Modules\Plan\Http\Requests\PlanLevel\StorePlanLevelRequest;
use Modules\Plan\Http\Requests\PlanLevel\UpdatePlanLevelRequest;

class PlanLevelController extends Controller
{
    public function index($type)
    {
        $this->checkAuthorization('planLevel_access');

        $planLevels = PlanLevel::with('planLevel')->where(function ($query) use ($type) {
            if ($type == 'planSubLevel') {
                $query->whereNotNull('plan_level_id');
            } else {
                $query->whereNull('plan_level_id');
            }
        })->get();

        return view('plan::admin.setting.plan_level.index', compact('planLevels', 'type'));
    }

    public function planSubLevel(Request $request)
    {
        $request->validate([
            'plan_level_id' => ['required']
        ]);

        $this->checkAuthorization('planLevel_access');

        return response()->json([
            'data' => PlanLevel::filterData($request->all())->get()
        ]);
    }

    public function create($type)
    {
        $this->checkAuthorization('planLevel_create');
        $mainPlanLevels = PlanLevel::whereNull('plan_level_id')->get();

        return view('plan::admin.setting.plan_level.create', compact('mainPlanLevels', 'type'));
    }

    public function store(StorePlanLevelRequest $request, $type)
    {
        $this->checkAuthorization('planLevel_create');
        PlanLevel::create($request->validated());

        toast('योजना स्तर सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function edit($type, PlanLevel $planLevel)
    {
        $this->checkAuthorization('planLevel_edit');
        $mainLevels = PlanLevel::whereNull('plan_level_id')->get();
        return view('plan::admin.setting.plan_level.edit', compact('planLevel', 'mainLevels', 'type'));
    }

    public function update(UpdatePlanLevelRequest $request, $type, PlanLevel $planLevel)
    {
        $this->checkAuthorization('planLevel_edit');
        $planLevel->update($request->validated());

        toast('योजना स्तर सफलतापूर्वक सम्पादन गरियो', 'success');
        return redirect(route('admin.plan.planLevel.index', $type));
    }

    public function destroy($type, PlanLevel $planLevel)
    {
        $this->checkAuthorization('planLevel_delete');
        $planLevel->planLevels()->delete();
        $planLevel->delete();

        toast('योजना स्तर सफलतापूर्वक मेटियो', 'success');
        return back();
    }
}

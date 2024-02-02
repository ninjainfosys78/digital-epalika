<?php

namespace Modules\Plan\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Plan\Entities\BudgetHead;
use Modules\Plan\Http\Requests\BudgetHead\StoreBudgetHeadRequest;
use Modules\Plan\Http\Requests\BudgetHead\UpdateBudgetHeadRequest;

class BudgetHeadController extends Controller
{
    public function index($type)
    {
        $this->checkAuthorization('budgetHead_access');

        $budgetHeads = BudgetHead::with('budgetHeads')->where(function ($query) use ($type) {
            if ($type == 'budgetSubHead') {
                $query->whereNotNull('budget_head_id');
            } else {
                $query->whereNull('budget_head_id');
            }
        })->get();

        return view('plan::admin.setting.budget_head.index', compact('budgetHeads', 'type'));
    }

    public function budgetSubHead(Request $request)
    {
        $request->validate([
            'budget_head_id' => ['required']
        ]);

        return response()->json([
            'data' => BudgetHead::filterData($request->all())->get()
        ]);
    }

    public function create($type)
    {
        $this->checkAuthorization('budgetHead_create');

        $mainBudgetHeads = BudgetHead::whereNull('budget_head_id')->get();

        return view('plan::admin.setting.budget_head.create', compact('mainBudgetHeads', 'type'));
    }

    public function store(StoreBudgetHeadRequest $request, $type)
    {
        $this->checkAuthorization('budgetHead_create');
        BudgetHead::create($request->validated());

        toast('बजेट शिर्षक सफलतापूर्वक थपियो ', 'success');
        return back();
    }

    public function edit($type, BudgetHead $budgetHead)
    {
        $this->checkAuthorization('budgetHead_edit');

        $mainBudgetHeads = BudgetHead::whereNull('budget_head_id')->get();

        return view('plan::admin.setting.budget_head.edit', compact('budgetHead', 'mainBudgetHeads', 'type'));
    }

    public function update(UpdateBudgetHeadRequest $request, $type, BudgetHead $budgetHead)
    {
        $this->checkAuthorization('budgetHead_edit');

        $budgetHead->update($request->validated());

        toast('बजेट शिर्षक सफलतापूर्वक सम्पादन गरियो', 'success');
        return redirect(route('admin.plan.budgetHead.index', $type));
    }

    public function destroy($type, BudgetHead $budgetHead)
    {
        $this->checkAuthorization('budgetHead_delete');
        $budgetHead->budgetHeads()->delete();
        $budgetHead->delete();

        toast('बजेट शिर्षक सफलतापूर्वक मेटाइयो', 'success');
        return back();
    }
}

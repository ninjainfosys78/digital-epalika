<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Branch\StoreBranchRequest;
use App\Http\Requests\Setting\Branch\UpdateBranchRequest;
use App\Models\Settings\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('branch_access');

        $branches = Branch::with('branches.branch')->whereNull('branch_id')->orderBy('branch_id')->paginate(10);

        return view('admin.global.branch.index', compact('branches'));
    }

    public function subBranch(Request $request)
    {
        $request->validate([
            'branch_id' => ['required']
        ]);

        return response()->json([
            'data' => Branch::filterData($request->all())->get()
        ]);
    }

    public function create()
    {
        $this->checkAuthorization('branch_create');

        $mainBranches = Branch::whereNull('branch_id')->get();

        return view('admin.global.branch.create', compact('mainBranches'));
    }

    public function store(StoreBranchRequest $request)
    {
        $this->checkAuthorization('branch_create');
        Branch::create($request->validated());

        toast('शाखा सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function edit(Branch $branch)
    {
        $this->checkAuthorization('branch_edit');
        $mainBranches = Branch::whereNull('branch_id')->get();

        return view('admin.global.branch.edit', compact('branch', 'mainBranches'));
    }

    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        $this->checkAuthorization('branch_edit');

        $branch->update($request->validated());

        toast('शाखा सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.global.generalSetting.branch.index'));
    }

    public function destroy(Branch $branch)
    {
        $this->checkAuthorization('branch_delete');
        $branch->branches()->delete();
        $branch->delete();

        toast('शाखा सफलतापूर्वक हटाइयो', 'success');

        return back();
    }
}

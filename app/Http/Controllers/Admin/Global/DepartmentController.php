<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Department\StoreDepartmentRequest;
use App\Http\Requests\Setting\Department\UpdateDepartmentRequest;
use App\Models\Settings\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('department_access');

        $departments = Department::latest()->get();

        return view('admin.global.department.index', compact('departments'));
    }

    public function create()
    {
        $this->checkAuthorization('department_create');
        return view('admin.global.department.create');
    }

    public function store(StoreDepartmentRequest $request)
    {
        $this->checkAuthorization('department_create');

        Department::create($request->validated());

        toast('विभाग सफलतापूर्वक थपियो !', 'success');

        return back();
    }

    public function edit(Department $department)
    {
        $this->checkAuthorization('department_edit');

        return view('admin.global.department.edit', compact('department'));
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $this->checkAuthorization('department_edit');

        $department->update($request->validated());
        toast('विभाग सफलतापूर्वक अद्यावधिक गरियो !', 'success');

        return redirect()->route('admin.global.department.index');
    }

    public function destroy(Department $department)
    {
        $this->checkAuthorization('department_delete');

        $department->delete();

        toast('विभाग सफलतापूर्वक हटाइयो!', 'success');

        return back();
    }
}

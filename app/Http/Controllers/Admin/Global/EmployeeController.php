<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Employee\StoreEmployeeRequest;
use App\Http\Requests\Setting\Employee\UpdateEmployeeRequest;
use App\Models\Ethnicity;
use App\Models\Settings\Branch;
use App\Models\Settings\Employee;
use App\Models\Settings\Experience;
use App\Models\Settings\ExperienceFile;
use App\Models\Settings\Qualification;
use App\Models\UserManagement\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;

class EmployeeController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('employee_access');

        $employees = Employee::orderBy('position')->where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['designation', 'name'], request('search'));
            }
        })
            ->latest()->paginate(10);


        return view('admin.global.employee.index', compact('employees'));
    }

    public function create()
    {
        $this->checkAuthorization('employee_create');
        $branches = Branch::with('branches')->whereNull('branch_id')->get();
        $ethnicities = Ethnicity::all();
        $allEmployees = Employee::all();
        $roles = Role::all();
        return view('admin.global.employee.create', compact('ethnicities', 'branches', 'allEmployees', 'roles'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $this->checkAuthorization('employee_create');

        $employee = Employee::create($request->validated());

        toast('कर्मचारी सफलतापूर्वक थपियो', 'success');
        return back()->with('success', 'कर्मचारी सफलतापूर्वक थपियो');
    }

    public function show(Employee $employee)
    {
        $qualifications = Qualification::all();
        $experiences = Experience::all();
        $experienceFiles = ExperienceFile::all();
        return view('admin.global.employee.show', compact('experienceFiles', 'qualifications', 'experiences'));
    }

    public function edit(Employee $employee)
    {
        $this->checkAuthorization('employee_edit');
        $branches = Branch::all();
        $ethnicities = Ethnicity::all();
        $allemployees = Employee::all();
        return view('admin.global.employee.edit', compact('ethnicities', 'employee', 'branches', 'allemployees'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $this->checkAuthorization('employee_edit');

        if ($request->hasFile('photo')) {
            if ($employee->photo) {
                $this->deleteFile($employee->photo);
            }
        }

        $employee->update($request->validated());

        toast('कर्मचारी सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.global.generalSetting.employee.index'));
    }

    public function destroy(Employee $employee)
    {
        $this->checkAuthorization('employee_delete');
        if ($employee->photo) {
            $this->deleteFile($employee->photo);
        }

        $employee->delete();
        toast(' कर्मचारी सफलतापूर्वक मेटाइयो', 'success');

        return back();
    }

    public function updateEmployeeStatus(Employee $employee): RedirectResponse
    {
        $this->checkAuthorization('employee_access');
        $employee->update([
            'status' => !$employee->status,
        ]);
        toast('कर्मचारी स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }
}

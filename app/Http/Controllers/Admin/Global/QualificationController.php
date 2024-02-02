<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Qualification\StoreQualificationRequest;
use App\Http\Requests\Setting\Qualification\UpdateQualificationRequest;
use App\Models\Settings\Employee;
use App\Models\Settings\Qualification;

class QualificationController extends Controller
{
    public function index(Employee $employee)
    {
        $this->checkAuthorization('qualification_access');
    }

    public function create(Employee $employee)
    {
        $this->checkAuthorization('qualification_create');
        return view('admin.global.employee.qualification.create', compact('employee'));
    }

    public function store(StoreQualificationRequest $request, Employee $employee)
    {
        $this->checkAuthorization('qualification_create');

        Qualification::create($request->validated() + [
                'employee_id' => $employee->id
            ]);
        toast('शैक्षिक योग्यता सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(Employee $employee, Qualification $qualification)
    {
        $this->checkAuthorization('qualification_access');
    }

    public function edit(Employee $employee, Qualification $qualification)
    {
        $this->checkAuthorization('qualification_edit');
        return view('admin.global.employee.qualification.edit', compact('employee', 'qualification'));
    }

    public function update(UpdateQualificationRequest $request, Employee $employee, Qualification $qualification)
    {
        $this->checkAuthorization('qualification_edit');
        $qualification->update($request->validated());
        toast('शैक्षिक योग्यता सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.global.generalSetting.employee.show', $employee));
    }

    public function destroy(Employee $employee, Qualification $qualification)
    {
        $this->checkAuthorization('qualification_delete');
        $qualification->delete();
        toast(' शैक्षिक योग्यता सफलतापूर्वक मेटाइयो', 'success');

        return back();
    }
}

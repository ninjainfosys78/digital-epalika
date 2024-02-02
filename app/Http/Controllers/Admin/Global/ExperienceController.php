<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Experience\StoreExperienceRequest;
use App\Http\Requests\Setting\Experience\UpdateExperienceRequest;
use App\Models\Settings\Employee;
use App\Models\Settings\Experience;

class ExperienceController extends Controller
{
    public function index(Employee $employee)
    {
        $this->checkAuthorization('experience_access');
    }

    public function create(Employee $employee)
    {
        $this->checkAuthorization('experience_create');
        return view('admin.global.employee.experience.create', compact('employee'));
    }

    public function store(StoreExperienceRequest $request, Employee $employee)
    {
        $this->checkAuthorization('experience_create');
        Experience::create($request->validated() + [
                'employee_id' => $employee->id
            ]);
        toast('कार्य अनुभव सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(Employee $employee, Experience $experience)
    {
        $this->checkAuthorization('experience_access');
    }

    public function edit(Employee $employee, Experience $experience)
    {
        $this->checkAuthorization('experience_edit');
        return view('admin.global.employee.experience.edit', compact('employee', 'experience'));
    }

    public function update(UpdateExperienceRequest $request, Employee $employee, Experience $experience)
    {
        $this->checkAuthorization('experience_edit');
        $experience->update($request->validated());
        toast('कार्य अनुभव सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.global.generalSetting.employee.show', $employee));
    }

    public function destroy(Employee $employee, Experience $experience)
    {
        $this->checkAuthorization('experience_delete');
        $experience->delete();
        toast('कार्य अनुभव सफलतापूर्वक मेटाइयो', 'success');

        return back();
    }
}

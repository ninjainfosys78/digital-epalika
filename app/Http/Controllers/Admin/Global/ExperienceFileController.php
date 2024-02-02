<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\ExperienceFile\StoreExperienceFileRequest;
use App\Http\Requests\Setting\ExperienceFile\UpdateExperienceFileRequest;
use App\Models\Settings\Employee;
use App\Models\Settings\ExperienceFile;

class ExperienceFileController extends Controller
{
    public function index(Employee $employee)
    {
        $this->checkAuthorization('experienceFile_access');
    }

    public function create(Employee $employee)
    {
        $this->checkAuthorization('experienceFile_create');
        return view('admin.global.employee.experienceFile.create', compact('employee'));
    }

    public function store(StoreExperienceFileRequest $request, Employee $employee)
    {
        $this->checkAuthorization('experienceFile_create');
        ExperienceFile::create($request->validated() + [
                'employee_id' => $employee->id
            ]);
        toast('फाईल सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(Employee $employee, ExperienceFile $experienceFile)
    {
        $this->checkAuthorization('experienceFile_access');
    }

    public function edit(Employee $employee, ExperienceFile $experienceFile)
    {
        $this->checkAuthorization('experienceFile_edit');
        return view('admin.global.employee.experienceFile.edit', compact('employee', 'experienceFile'));
    }

    public function update(UpdateExperienceFileRequest $request, Employee $employee, ExperienceFile $experienceFile)
    {
        $this->checkAuthorization('experienceFile_edit');
        if ($request->hasFile('file') && $data = $experienceFile->getRawOriginal('file')) {
            $this->deleteFile($data);
        }
        $experienceFile->update($request->validated());
        toast('फाईल सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.global.generalSetting.employee.show', $employee));
    }

    public function destroy(Employee $employee, ExperienceFile $experienceFile)
    {
        $this->checkAuthorization('experienceFile_delete');
        $experienceFile->delete();
        if ($data = $experienceFile->getRawOriginal('file')) {
            $this->deleteFile($data);
        }
        toast('फाईल सफलतापूर्वक मेटाइयो', 'success');
        return back();
    }
}

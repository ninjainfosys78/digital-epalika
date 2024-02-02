<?php

namespace Modules\Roaster\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Modules\Roaster\Entities\Subject;
use Modules\Roaster\Http\Requests\Settings\Subject\StoreSubjectRequest;
use Modules\Roaster\Http\Requests\Settings\Subject\UpdateSubjectRequest;

class SubjectController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('subject_access');
        $subjects = Subject::latest()->get();

        return view('roaster::admin.setting.subject.index', compact('subjects'));
    }

    public function create()
    {
        $this->checkAuthorization('subject_create');

        return view('roaster::admin.setting.subject.create');
    }

    public function store(StoreSubjectRequest $request)
    {
        $this->checkAuthorization('subject_create');
        Subject::create($request->validated());

        toast('Subject Created Successfully', 'success');

        return redirect(route('admin.roaster.setting.subject.index'));
    }

    public function show(Subject $subject)
    {
        $this->checkAuthorization('subject_access');

        return view('roaster::show');
    }

    public function edit(Subject $subject)
    {
        $this->checkAuthorization('subject_edit');

        return view('roaster::admin.setting.subject.edit', compact('subject'));
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $this->checkAuthorization('subject_edit');
        $subject->update($request->validated());
        toast('Subject Updated Successfully', 'success');

        return redirect(route('admin.roaster.setting.subject.index'));
    }

    public function destroy(Subject $subject)
    {
        $this->checkAuthorization('subject_delete');
        $subject->delete();
        toast('Subject Deleted Successfully', 'success');

        return back();
    }
}

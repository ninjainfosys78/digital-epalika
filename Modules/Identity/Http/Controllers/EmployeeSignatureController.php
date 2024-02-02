<?php

namespace Modules\Identity\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Identity\Entities\EmployeeSignature;
use Modules\Identity\Http\Requests\EmployeeSignature\StoreEmployeeSignatureRequest;
use Modules\Identity\Http\Requests\EmployeeSignature\UpdateEmployeeSignatureRequest;

class EmployeeSignatureController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('employeeSignature_access');
        $employeeSignatures = EmployeeSignature::latest()->paginate(10);
        return view('identity::admin.setting.employeeSignature.index', compact('employeeSignatures'));
    }

    public function create()
    {
        $this->checkAuthorization('employeeSignature_create');
        return view('identity::admin.setting.employeeSignature.create');
    }

    public function store(StoreEmployeeSignatureRequest $request)
    {
        $this->checkAuthorization('employeeSignature_create');
        EmployeeSignature::create($request->validated());
        toast('प्रसाशाक  सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(EmployeeSignature $employeeSignature)
    {
        $this->checkAuthorization('employeeSignature_access');
        return view('identity::show');
    }

    public function edit(EmployeeSignature $employeeSignature)
    {
        $this->checkAuthorization('employeeSignature_edit');
        return view('identity::admin.setting.employeeSignature.edit', compact('employeeSignature'));
    }

    public function update(UpdateEmployeeSignatureRequest $request, EmployeeSignature $employeeSignature)
    {
        $this->checkAuthorization('employeeSignature_edit');

        if ($request->hasFile('stamp') && $employeeSignature->getRawOriginal('stamp')) {
            $this->deleteFile($employeeSignature->getRawOriginal('stamp'));
        }
        if ($request->hasFile('red_signature') && $employeeSignature->getRawOriginal('red_signature')) {
            $this->deleteFile($employeeSignature->getRawOriginal('red_signature'));
        }
        if ($request->hasFile('black_signature') && $employeeSignature->getRawOriginal('black_signature')) {
            $this->deleteFile($employeeSignature->getRawOriginal('black_signature'));
        }

        $employeeSignature->update($request->validated());
        toast('प्रसाशाक सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('identity.admin.setting.employeeSignature.index'));
    }

    public function destroy(EmployeeSignature $employeeSignature)
    {
        $this->checkAuthorization('employeeSignature_delete');
        if ($employeeSignature->getRawOriginal('stamp')) {
            $this->deleteFile($employeeSignature->getRawOriginal('stamp'));
        }
        if ($employeeSignature->getRawOriginal('red_signature')) {
            $this->deleteFile($employeeSignature->getRawOriginal('red_signature'));
        }
        if ($employeeSignature->getRawOriginal('black_signature')) {
            $this->deleteFile($employeeSignature->getRawOriginal('black_signature'));
        }
        $employeeSignature->delete();
        toast('प्रसाशाक सफलतापूर्वक मेटियो', 'success');
        return back();
    }

    public function updateStatus(EmployeeSignature $employeeSignature)
    {
        $employeeSignature->update([
            'status' => !$employeeSignature->status
        ]);
        toast('प्रसाशाक स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }
}

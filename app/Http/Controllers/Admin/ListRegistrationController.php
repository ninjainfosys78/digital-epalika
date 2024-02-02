<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Modules\ListRegistration\Entities\ListRegistration;
use Modules\ListRegistration\Http\Requests\ListRegistration\StoreListRegistrationRequest;
use Modules\ListRegistration\Http\Requests\ListRegistration\UpdateListRegistrationRequest;

class ListRegistrationController extends Controller
{
    public function index()
    {
        abort_if(
            Gate::denies('listRegistration_access'),
            403,
            'You are not allowed to list registration access'
        );

        $listRegistrations = ListRegistration::latest()->get();

        return view('listregistration::admin.list_registration.index', compact('listRegistrations'));
    }

    public function create()
    {
        abort_if(
            Gate::denies('listRegistration_create'),
            403,
            'You are not allowed to list registration create'
        );
        $registration_no = 'R-' . Str::padLeft(DB::table('list_registrations')->max('id') + 1, 2, 0);

        return view('listregistration::admin.list_registration.create', compact('registration_no'));
    }

    public function store(StoreListRegistrationRequest $request)
    {
        abort_if(
            Gate::denies('listRegistration_create'),
            403,
            'You are not allowed to list registration create'
        );

        DB::transaction(function () use ($request) {
            $listRegistration = ListRegistration::create($request->validated());

            if (!empty($request->validated()['files'])) {
                $this->uploadDocuments($request, $listRegistration);
            }
        });

        toast('मौजुदा सुची दर्ता सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(ListRegistration $listRegistration)
    {
        abort_if(
            Gate::denies('listRegistration_access'),
            403,
            'You are not allowed to list registration access'
        );
        $listRegistration->load('files');
        return view('listregistration::admin.list_registration.show', compact('listRegistration'));
    }

    public function edit(ListRegistration $listRegistration)
    {
        abort_if(
            Gate::denies('listRegistration_edit'),
            403,
            'You are not allowed to list registration edit'
        );

        return view('listregistration::admin.list_registration.edit', compact('listRegistration'));
    }

    public function update(UpdateListRegistrationRequest $request, ListRegistration $listRegistration)
    {
        abort_if(
            Gate::denies('listRegistration_edit'),
            403,
            'You are not allowed to list registration edit'
        );
        DB::transaction(function () use ($request, $listRegistration) {
            if ($request->hasFile('application_photo') && $listRegistration->application_photo) {
                $this->deleteFile($listRegistration->application_photo);
            }
            if ($request->hasFile('registration_certificate') && $listRegistration->registration_certificate) {
                $this->deleteFile($listRegistration->registration_certificate);
            }
            if ($request->hasFile('pan_photo') && $listRegistration->pan_photo) {
                $this->deleteFile($listRegistration->pan_photo);
            }
            if ($request->hasFile('tax_payment_certificate') && $listRegistration->tax_payment_certificate) {
                $this->deleteFile($listRegistration->tax_payment_certificate);
            }
            if ($request->hasFile('license_photo') && $listRegistration->license_photo) {
                $this->deleteFile($listRegistration->license_photo);
            }

            $listRegistration->update($request->validated());

            if (!empty($request->validated()['files'])) {
                $this->uploadDocuments($request, $listRegistration);
            }
        });

        toast('मौजुदा सुची दर्ता सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.listRegistrations.listRegistration.index'));
    }

    public function destroy(ListRegistration $listRegistration)
    {
        abort_if(
            Gate::denies('listRegistration_delete'),
            403,
            'You are not allowed to list registration delete'
        );
        foreach ($listRegistration->files as $file) {
            $this->deleteFile($file->file);
        }
        $listRegistration->files()->delete();
        if ($listRegistration->application_photo) {
            $this->deleteFile($listRegistration->application_photo);
        }
        if ($listRegistration->registration_certificate) {
            $this->deleteFile($listRegistration->registration_certificate);
        }
        if ($listRegistration->pan_photo) {
            $this->deleteFile($listRegistration->pan_photo);
        }
        if ($listRegistration->tax_payment_certificate) {
            $this->deleteFile($listRegistration->tax_payment_certificate);
        }
        if ($listRegistration->license_photo) {
            $this->deleteFile($listRegistration->license_photo);
        }
        $listRegistration->delete();

        toast('मौजुदा सुची दर्ता सफलतापूर्वक मेटाइयो', 'success');

        return back();
    }

    private function uploadDocuments($request, $listRegistration)
    {
        foreach ($request->validated()['files'] as $file) {
            $listRegistration->files()->create([
                'file_name' => $file['file_name'] ?? pathinfo($file['file']->getClientOriginalName(), PATHINFO_FILENAME),
                'extension' => $file['file']->getClientOriginalExtension(),
                'file' => $file['file']->store('list_registration/' . Str::slug($listRegistration->main_person, '_') . '/files', 'public')
            ]);
        }
    }
}

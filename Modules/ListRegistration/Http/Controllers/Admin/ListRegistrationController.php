<?php

namespace Modules\ListRegistration\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings\OfficeSetting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\ListRegistration\Entities\ListRegistration;
use Modules\ListRegistration\Http\Requests\ListRegistration\StoreListRegistrationRequest;
use Modules\ListRegistration\Http\Requests\ListRegistration\UpdateListRegistrationRequest;

class ListRegistrationController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('listRegistration_access');

        $listRegistrations = ListRegistration::where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['name'], request('search'));
            }
        })
            ->latest()->paginate(10);

        return view('listregistration::admin.list_registration.index', compact('listRegistrations'));
    }

    public function create()
    {
        $this->checkAuthorization('listRegistration_create');
        $registration_no = 'R-' . Str::padLeft(DB::table('list_registrations')->max('id') + 1, 2, 0);

        return view('listregistration::admin.list_registration.create', compact('registration_no'));
    }

    public function store(StoreListRegistrationRequest $request)
    {
        $this->checkAuthorization('listRegistration_create');

        DB::transaction(function () use ($request) {
            $listRegistration = ListRegistration::create($request->validated() + [
                    'fiscal_year_id' => OfficeSetting::first()->fiscal_year_id
                ]);

            if (!empty($request->validated()['files'])) {
                $this->uploadDocuments($request, $listRegistration);
            }
        });

        toast('मौजुदा सुची दर्ता सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function show(ListRegistration $listRegistration)
    {
        $this->checkAuthorization('listRegistration_access');
        $listRegistration->load('files');

        return view('listregistration::admin.list_registration.show', compact('listRegistration'));
    }

    public function edit(ListRegistration $listRegistration)
    {
        $this->checkAuthorization('listRegistration_edit');

        return view('listregistration::admin.list_registration.edit', compact('listRegistration'));
    }

    public function update(UpdateListRegistrationRequest $request, ListRegistration $listRegistration)
    {
        $this->checkAuthorization('listRegistration_edit');
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
        $this->checkAuthorization('listRegistration_delete');
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
                'file' => $file['file']->store('list_registration/' . Str::slug($listRegistration->main_person, '_') . '/files', 'public'),
            ]);
        }
    }

    public function updateFile(Request $request, ListRegistration $listRegistration)
    {
        $this->checkAuthorization('listRegistration_edit');

        if ($request->hasFile('file') && $file = $listRegistration->getRawOriginal('file')) {
            $this->deleteFile($file);
        }
        $data = $request->validate([
            'file' => 'required |mimes:png,jpg,jpeg,pdf'
        ]);

        $listRegistration->update($data);
        toast('फाईल सफलतापूर्वक थपियो', 'success');
        return back();
    }
}

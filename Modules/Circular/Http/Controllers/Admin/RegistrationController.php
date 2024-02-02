<?php

namespace Modules\Circular\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationAcceptMail;
use App\Mail\RegistrationMail;
use App\Models\Settings\Branch;
use App\Models\Settings\OfficeSetting;
use App\Models\User;
use App\Notifications\RegistrationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Modules\Circular\Entities\Registration;
use Modules\Circular\Http\Requests\Registration\StoreRegistrationRequest;
use Modules\Circular\Http\Requests\Registration\UpdateRegistrationRequest;
use Illuminate\Database\Eloquent\Builder;
use Modules\Circular\Traits\RegistrationTrait;

class RegistrationController extends Controller
{
    use RegistrationTrait;

    public function index()
    {
        $this->checkAuthorization('registration_access');

        $registrations = Registration::where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['registration_no', 'letter_number', 'sender_name', 'subject',], request('search'));
            }
        })
            ->latest()->paginate(10);


        return view('circular::admin.registration.index', compact('registrations'));
    }

    public function create()
    {
        $this->checkAuthorization('registration_create');
        $registration_no = $this->getRegistrationNumber();
        $branches = Branch::all();
        return view('circular::admin.registration.create', compact('registration_no', 'branches'));
    }

    public function store(StoreRegistrationRequest $request)
    {
        $this->checkAuthorization('registration_create');


        DB::transaction(function () use ($request) {
            $user = User::where('branch_id', $request->input('branch_id'))->where('is_dept_head', true)->first();
            $registration = Registration::create($request->validated() + [
                    'fiscal_year_id' => OfficeSetting::first()->fiscal_year_id,
                    'prefix' => $this->getRegistrationPrefix(),
                    'registration_no' => $this->getRegistrationNo(),
                    'user_id' => auth()->id(),
                ]);
            $notification = new RegistrationNotification($registration);
            if (!empty($user)) {
                Notification::send($user, $notification);
            } else {
                $userData = User::where('branch_id', $request->input('branch_id'))->first();
                if ($userData) {
                    Notification::send($userData, $notification);
                }
            }
            if (!empty($request->input('email'))) {
                Mail::to($request->input('email'))->send(new RegistrationMail($registration));
            }
            $this->uploadDocuments($request, $registration);
        });

        toast('दर्ता सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(Registration $registration)
    {
        $this->checkAuthorization('registration_access');
        $registration->load('fiscalYear', 'files');

        return view('circular::admin.registration.show', compact('registration'));
    }

    public function edit(Registration $registration)
    {
        $this->checkAuthorization('registration_edit');
        $branches = Branch::all();
        return view('circular::admin.registration.edit', compact('registration', 'branches'));
    }

    public function update(UpdateRegistrationRequest $request, Registration $registration)
    {
        $this->checkAuthorization('registration_edit');

        DB::transaction(function () use ($request, $registration) {
            if ($request->hasFile('signature_image') && $registration->signature_image) {
                $this->deleteFile($registration->signature_image);
            }

            $registration->update($request->validated());

            if ($request->hasFile('documents')) {
                $this->uploadDocuments($request, $registration);
            }
        });

        toast('दर्ता सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.circular.registration.index'));
    }

    public function destroy(Registration $registration)
    {
        $this->checkAuthorization('registration_delete');
        foreach ($registration->files as $file) {
            $this->deleteFile($file->file);
        }
        $registration->files()->delete();
        if ($registration->signature_image) {
            $this->deleteFile($registration->signature_image);
        }
        $registration->delete();

        toast('दर्ता सफलतापूर्वक मेटियो', 'success');

        return back();
    }


    public function updateStatus(Request $request, Registration $registration)
    {
        DB::transaction(function () use ($request, $registration) {
            $registration->update([
                'status' => $request->input('status'),
            ]);
            $user = User::findOrFail($registration->user_id);
            Notification::send($user, new RegistrationNotification($registration));
            Mail::to($registration->email)->send(new RegistrationAcceptMail($registration));
        });


        toast('दर्ता सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }

    private function uploadDocuments($request, $registration)
    {
        foreach ($request->validated()['documents'] as $document) {
            $registration->files()->create([
                'file_name' => pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME),
                'extension' => $document->getClientOriginalExtension(),
                'file' => $document->store('Registration/' . Str::slug($registration->registration_no ?? $registration->receiver_name, '_'), 'public'),
            ]);
        }
    }
}

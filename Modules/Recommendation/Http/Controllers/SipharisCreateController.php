<?php

namespace Modules\Recommendation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Recommendation\Entities\SipharishCreate;
use Modules\Recommendation\Http\Requests\SipharishCreated\StoreSipharisCreatedRequest;
use Illuminate\Support\Facades\DB;

class SipharisCreateController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('recommendationCategory_access');

        $sipharishCreates = SipharishCreate::with('SipharishFormType', 'personalDetail', 'mobileUser')->latest()->get();
        return view('recommendation::admin.sipharisCreate.index', compact('sipharishCreates'));
    }

    public function create()
    {
        return view('recommendation::admin.sipharisCreate.create');
    }

    public function store(StoreSipharisCreatedRequest $request)
    {
        //        dd($request->validated());
        $sipharis = DB::transaction(function () use ($request) {

            $sipharis = SipharishCreate::create($request->validated() + [
                'created_by' => auth()->id()
            ]);

            if (
                array_key_exists('fields', $request->validated())
                && !empty($request->validated()['fields'])
            ) {

                foreach ($request->validated()['fields'] as $field) {

                    if (!empty($field['type']) && $field['type'] == 'image') {
                        $value = Storage::disk('public')
                            ->putFile('recommendation/files', $field['value']);
                    } else {
                        $value = $field['value'];
                    }
                    $sipharis->SipharishCreatedValues()
                        ->create([
                            'sipharish_form_field_id' => $field['sipharish_form_field_id'] ?? '',
                            'value' => $value ?? '',
                            'type' => $field['type'] ?? '',
                        ]);
                }
            }

            if (
                array_key_exists('files', $request->validated())
                && !empty($request->validated()['files'])
            ) {

                foreach ($request->validated()['files'] as $file) {
                    $sipharis->SipharisCreatedDocuments()->create($file + [
                        'extension' => $file['filename']->getClientOriginalExtension()
                    ]);
                }
            }

            return $sipharis;
        });

        toast('सिफारिस सफलतापूर्वक थपियो', 'success');
        return redirect(route('admin.recommendation.sipharish.sipharishCreate.show', $sipharis->id));
    }

    public function edit(SipharishCreate $sipharishCreate)
    {
        $sipharishCreate->load('SipharishCreatedValues.SipharisFormField', 'SipharisCreatedDocuments');
        return view('recommendation::admin.sipharisCreate.edit', compact('sipharishCreate'));
    }

    public function show(SipharishCreate $sipharishCreate)
    {

        $sipharishCreate->load('SipharishCreatedValues.SipharisFormField', 'SipharisCreatedDocuments');
        return view('recommendation::admin.sipharisCreate.view', compact('sipharishCreate'));
    }

    public function updateStatus(SipharishCreate $sipharishCreate)
    {
        $this->checkAuthorization('recommendationTemplate_access');

        $sipharishCreate->update([
            'status' => !$sipharishCreate->status
        ]);
        toast('टेम्प्लेट स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    public function fileUpload(Request $request, SipharishCreate $sipharishCreate)
    {
        $data = $request->validate([
            'file' => ['required', 'file']
        ]);
        $sipharishCreate->update($data);
        toast('फाइल सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    public function destroy(SipharishCreate $sipharishCreate)
    {
        $this->checkAuthorization('recommendationCategory_delete');
        if ($sipharishCreate->status == 1) {
            toast('सक्रिय भएको सिफारिस प्रकार मेटाउन मनाहि छ', 'error');

            return back();
        }
        $sipharishCreate->delete();
        toast('सिफारिस सफलतापूर्वक मेटियो', 'success');
        return back();
    }
}

<?php

namespace Modules\Recommendation\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Recommendation\Entities\SipharisFormField;
use Modules\Recommendation\Entities\SipharishFormType;
use Modules\Recommendation\Http\Requests\SipharisFormType\StoreSipharisFormTypeRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Modules\Recommendation\Http\Requests\SipharisFormType\UpdateSipharisFormTypeRequest;

class SipharishFormTypeController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('recommendationCategory_access');
        $sipharishFormTypes = SipharishFormType::with("sipharisSubCategory")->get();
        return view('recommendation::admin.sipharisFormType.index', compact('sipharishFormTypes'));
    }

    public function create()
    {
        return view('recommendation::admin.sipharisFormType.create');
    }

    public function store(StoreSipharisFormTypeRequest $request)
    {

        DB::transaction(function () use ($request) {
            $sipharis = SipharishFormType::create($request->validated() + [
                    'created_by' => auth()->id()
                ]);

            if ($sipharis && !empty($request->validated()['fields'])) {
                foreach ($request->input('fields') as $data) {
                    $sipharis->sipharisFormFields()->create($data + [
                            'created_by' => auth()->id()
                        ]);
                }
            }
        });
        toast('सिफारिस सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function edit(SipharishFormType $sipharishFormType)
    {
        $sipharishFormType->load('sipharisFormFields.SipharishFormFields', 'sipharisSubCategory');
        return view('recommendation::admin.sipharisFormType.edit', compact('sipharishFormType'));
    }

    public function update(UpdateSipharisFormTypeRequest $request, SipharishFormType $sipharishFormType)
    {
        $this->checkAuthorization('recommendationCategory_edit');
        DB::transaction(function () use ($request, $sipharishFormType) {
            $sipharishFormType->load('sipharisFormFields');
            $sipharishFormType->update($request->validated());
            $existingFormFieldsId = collect($sipharishFormType->sipharisFormFields?->pluck('id'));
            $newId = collect();
            if (!empty($request->validated()['fields'])) {
                foreach ($request->input('fields') as $formData) {
                    $newId->push($formData['id'] ?? null);

                    if (array_key_exists('id', $formData) && !empty($formData['id'])) {
                        SipharisFormField::find($formData['id'])?->update($formData);
                    } else {
                        $sipharishFormType->sipharisFormFields()->create(
                            $formData + [
                                'created_by' => auth()->id()
                            ]
                        );
                    }
                }
            }

            $diff = $existingFormFieldsId->diff($newId->filter());

            SipharisFormField::whereIn('id', $diff)->delete();
        });
        toast('सिफारिस सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    public function updateStatus(SipharishFormType $sipharisFormType)
    {
        $this->checkAuthorization('recommendationTemplate_access');

        $sipharisFormType->update([
            'status' => !$sipharisFormType->status
        ]);
        toast('टेम्प्लेट स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    public function show(SipharishFormType $sipharishFormType)
    {
        $sipharishFormType->load('sipharisFormFields');
        return view('recommendation::admin.sipharisFormType.show', compact('sipharishFormType'));
    }

    public function updateTemplate(Request $request, SipharishFormType $sipharishFormType)
    {
        $this->checkAuthorization('recommendationTemplate_access');
        $request->validate([
            'content' => ['required']
        ]);

        $sipharishFormType->update([
            'content' => $request->input('content')
        ]);
        toast('टेम्प्लेट स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    public function destroy(SipharishFormType $sipharishFormType)
    {
        $this->checkAuthorization('recommendationCategory_delete');
        if ($sipharishFormType->status) {
            toast('सक्रिय भएको सिफारिस प्रकार मेटाउन मनाहि छ', 'error');
            return back();
        }
        $sipharishFormType->sipharisFormFields()->delete();
        $sipharishFormType->delete();
        toast('सिफारिस सफलतापूर्वक मेटियो', 'success');
        return back();
    }
}

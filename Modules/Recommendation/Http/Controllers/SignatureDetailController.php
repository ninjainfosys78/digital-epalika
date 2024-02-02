<?php

namespace Modules\Recommendation\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Recommendation\Entities\SipharisSignatureDetail;
use Modules\Recommendation\Http\Requests\SignatureDetail\StoreSignatureRequest;
use Modules\Recommendation\Http\Requests\SignatureDetail\UpdateSignatureRequest;

class SignatureDetailController extends Controller
{
    public function index()
    {
        $signatureDetails = SipharisSignatureDetail::latest()->get();
        return view('recommendation::admin.signatureDetail.index', compact('signatureDetails'));
    }

    public function create()
    {
        return view('recommendation::admin.signatureDetail.create');
    }

    public function store(StoreSignatureRequest $request)
    {
        $this->checkAuthorization('recommendationCategory_create');

        SipharisSignatureDetail::create($request->validated() + [
                'created_by' => auth()->id()
            ]);
        toast('सिफारिस सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function edit(SipharisSignatureDetail $sipharisSignatureDetail)
    {
        $this->checkAuthorization('recommendationCategory_edit');
        return view('recommendation::admin.signatureDetail.edit', compact('sipharisSignatureDetail'));

    }

    public function update(UpdateSignatureRequest $request, SipharisSignatureDetail $sipharisSignatureDetail)
    {
        $this->checkAuthorization('recommendationCategory_edit');
        if ($request->hasFile('signature') && $sipharisSignatureDetail->getRawOriginal('signature')) {
            $this->deleteFile($sipharisSignatureDetail->getRawOriginal('signature'));
        }
        $sipharisSignatureDetail->update($request->validated());
        toast('सिफारिस हस्ताक्षर अद्यावधिक गरियो', 'success');
        return back();
    }

    public function updateStatus(SipharisSignatureDetail $sipharisSignatureDetail)
    {
        $this->checkAuthorization('recommendationTemplate_access');

        $sipharisSignatureDetail->update([
            'status' => !$sipharisSignatureDetail->status
        ]);
        toast('टेम्प्लेट स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    public function destroy(SipharisSignatureDetail $sipharisSignatureDetail)
    {
        $this->checkAuthorization('recommendationCategory_delete');
        if ($sipharisSignatureDetail->status == 1) {
            toast('सक्रिय भएको सिफारिस प्रकार मेटाउन मनाहि छ', 'error');

            return back();
        }
        $sipharisSignatureDetail->delete();
        toast('सिफारिस सफलतापूर्वक मेटियो', 'success');
        return back();
    }

}

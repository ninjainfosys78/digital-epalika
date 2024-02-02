<?php

namespace Modules\Recommendation\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Recommendation\Entities\SipharisCategory;
use Modules\Recommendation\Entities\SipharisFormType;
use Modules\Recommendation\Entities\SipharisFormFields;
use Modules\Recommendation\Http\Requests\SipharisFormType\StoreSipharisFormTypeRequest;
use Illuminate\Http\Request;

class SipharisFormFieldsController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('recommendationCategory_access');
        $sipharishFormTypes = SipharisFormType::getSipharisFormTypes();
        return view('recommendation::admin.sipharisFormType.index', compact('sipharishFormTypes'));
    }

    public function create($formType)
    {
        $sipharishCategories = SipharisCategory::all();
        return view('recommendation::admin.sipharisFormFields.create', compact('sipharishCategories'));
    }
    public function store(Request $request, $sipharis)
    {
        //dd($request->all() );
        foreach($request['field'] as $data) {
            //dd($data);die;
            SipharisFormFields::create([
                'sipharish_form_type_id' => $sipharis,
                'field_name' => $data['field_name'],
                'status'    => $data['status'] ?? 'active',
                'created_by' => auth()->id(),
                ]);
        }
        toast('सिफारिस form प्रकारमा field सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function edit(SipharisFormType $sipharisFormTypeModel)
    {
        $sipharishFormType = SipharisFormType::find($sipharisFormTypeModel->id);
        $sipharishCategories = SipharisCategory::all();
        $getOnesipharisSubCategory = SipharisCategory::where('id', $sipharishFormType->sipharis_sub_category_id)->first();
        return view(
            'recommendation::admin.sipharisFormType.edit',
            compact('sipharishFormType', 'sipharisFormTypeModel', 'getOnesipharisSubCategory', 'sipharishCategories')
        );

    }
    public function update(StoreSipharisFormTypeRequest $sipharishStoreRequest, SipharisFormType $sipharisFormTypeModel)
    {
        $this->checkAuthorization('recommendationCategory_edit');
        $sipharisFormTypeModel->update($sipharishStoreRequest->validated());
        toast('सिफारिस सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    public function updateStatus($sipharishFormType)
    {
        $this->checkAuthorization('recommendationTemplate_access');

        $getsipharishFormType = SipharisFormType::find($sipharishFormType);
        if($getSipharisCategory->status == 'active') {
            $sipharishFormType->update(['status' => 'inactive']);
        } else {
            $sipharishFormType->update(['status' => 'active']);
        }
        toast('टेम्प्लेट स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }



}

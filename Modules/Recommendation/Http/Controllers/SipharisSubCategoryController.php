<?php

namespace Modules\Recommendation\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Recommendation\Entities\SipharisCategory;
use Modules\Recommendation\Entities\SipharisSubCategory;
use Modules\Recommendation\Http\Requests\SipharisSubCategory\StoreSipharisSubCategoryRequest;

class SipharisSubCategoryController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('recommendationCategory_access');
        $sipharisSubCategories = SipharisSubCategory::with('sipharisCategory')->latest()->get();
        return view('recommendation::admin.sipharishSubCategory.index', compact('sipharisSubCategories'));
    }

    public function create()
    {
        $this->checkAuthorization('recommendationCategory_create');
        $sipharisCategories = SipharisCategory::status()->get();
        return view('recommendation::admin.sipharishSubCategory.create', compact('sipharisCategories'));
    }

    public function store(StoreSipharisSubCategoryRequest $request, SipharisSubCategory $sipharishSubCategory)
    {
        $this->checkAuthorization('recommendationCategory_create');
        SipharisSubCategory::create($request->validated() + [
                'created_by' => auth()->id()
            ]);
        toast('सिफारिस सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function edit(SipharisSubCategory $sipharishSubCategory)
    {
        $this->checkAuthorization('recommendationCategory_edit');
        $sipharisCategories = SipharisCategory::status()->get();

        return view('recommendation::admin.sipharishSubCategory.edit', compact('sipharisCategories', 'sipharishSubCategory'));

    }

    public function update(StoreSipharisSubCategoryRequest $request, SipharisSubCategory $sipharishSubCategory)
    {
        $this->checkAuthorization('recommendationCategory_edit');
        $sipharishSubCategory->update($request->validated());
        toast('सिफारिस सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    public function updateStatus(SipharisSubCategory $sipharisSubCategory)
    {
        $this->checkAuthorization('recommendationTemplate_access');

        $sipharisSubCategory->update([
            'status' => !$sipharisSubCategory->status
        ]);
        toast('टेम्प्लेट स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    public function destroy(SipharisSubCategory $sipharishSubCategory)
    {

        $this->checkAuthorization('recommendationCategory_delete');
        if ($sipharishSubCategory->status) {
            toast('सक्रिय भएको सिफारिस प्रकार मेटाउन मनाहि छ', 'error');

            return back();
        }
        $sipharishSubCategory->delete();
        toast('सिफारिस सफलतापूर्वक मेटियो', 'success');
        return back();
    }

}

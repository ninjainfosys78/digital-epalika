<?php

namespace Modules\Recommendation\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Recommendation\Entities\SipharisCategory;
use Modules\Recommendation\Http\Requests\SipharisCategory\StoreSipharisCategoryRequest;
use Modules\Recommendation\Http\Requests\SipharisCategory\UpdateSipharisCategoryRequest;

class SipharishCategoryController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('recommendationCategory_access');
        $recommendationCategories = SipharisCategory::latest()->get();
        return view('recommendation::admin.sipharishCategory.index', compact('recommendationCategories'));
    }

    public function create()
    {
        $this->checkAuthorization('recommendationCategory_create');
        return view('recommendation::admin.sipharishCategory.create');
    }

    public function store(StoreSipharisCategoryRequest $request)
    {
        $this->checkAuthorization('recommendationCategory_create');
        SipharisCategory::create($request->validated() + [
                'created_by' => auth()->id()
            ]);
        toast('सिफारिस सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function edit(SipharisCategory $sipharishCategory)
    {
        $this->checkAuthorization('recommendationCategory_edit');
        return view('recommendation::admin.sipharishCategory.edit', compact('sipharishCategory'));

    }

    public function update(UpdateSipharisCategoryRequest $request, SipharisCategory $sipharishCategory)
    {
        $this->checkAuthorization('recommendationCategory_edit');
        $sipharishCategory->update($request->validated());
        toast('सिफारिस सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    public function updateStatus(SipharisCategory $sipharisModel)
    {
        $this->checkAuthorization('recommendationTemplate_access');

        $sipharisModel->update([
            'status' => !$sipharisModel->status
        ]);
        toast('टेम्प्लेट स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    public function destroy(SipharisCategory $sipharishCategory)
    {
        $this->checkAuthorization('recommendationCategory_delete');
        if ($sipharishCategory->status) {
            toast('सक्रिय भएको सिफारिस प्रकार मेटाउन मनाहि छ', 'error');
            return back();
        }
        $sipharishCategory->delete();
        toast('सिफारिस सफलतापूर्वक मेटियो', 'success');
        return back();
    }

}

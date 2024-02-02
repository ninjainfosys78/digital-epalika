<?php

namespace Modules\BusinessRegistration\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\BusinessRegistration\Entities\ObjectTransaction;
use Modules\BusinessRegistration\Entities\ObjectTransactionSubCategory;
use Modules\BusinessRegistration\Http\Requests\ObjectTransactionSubCategory\StoreObjectTransactionSubCategoryRequest;
use Modules\BusinessRegistration\Http\Requests\ObjectTransactionSubCategory\UpdateObjectTransactionSubCategoryRequest;

class ObjectTransactionSubCategoryController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('objectTransactionSubCategory_access');
        $objectTransactionSubCategories = ObjectTransactionSubCategory::with('objectTransaction')->get();

        return view('businessregistration::admin.setting.objectTransactionSubCategory.index', compact('objectTransactionSubCategories'));
    }

    public function create()
    {
        $this->checkAuthorization('objectTransactionSubCategory_create');
        $all_objectTransactions = ObjectTransaction::get();

        return view('businessregistration::admin.setting.objectTransactionSubCategory.create', compact('all_objectTransactions'));
    }

    public function store(StoreObjectTransactionSubCategoryRequest $request)
    {
        $this->checkAuthorization('objectTransactionSubCategory_create');
        ObjectTransactionSubCategory::create($request->validated());
        toast(' कारोबार गर्ने वस्तु  सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }

    public function show($id)
    {
        $this->checkAuthorization('objectTransactionSubCategory_access');

        return view('businessregistration::show');
    }

    public function edit(ObjectTransactionSubCategory $objectTransactionSubCategory)
    {
        $this->checkAuthorization('objectTransactionSubCategory_edit');
        $all_objectTransactions = ObjectTransaction::get();

        return view('businessregistration::admin.setting.objectTransactionSubCategory.edit', compact('objectTransactionSubCategory', 'all_objectTransactions'));
    }

    public function update(UpdateObjectTransactionSubCategoryRequest $request, ObjectTransactionSubCategory $objectTransactionSubCategory)
    {
        $this->checkAuthorization('objectTransactionSubCategory_edit');
        $objectTransactionSubCategory->update($request->validated());
        toast('  सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.businessRegistration.setting.objectTransactionSubCategory.index'));
    }

    public function destroy(ObjectTransactionSubCategory $objectTransactionSubCategory)
    {
        $this->checkAuthorization('objectTransactionSubCategory_delete');
        $objectTransactionSubCategory->delete();

        return back();
    }
}

<?php

namespace Modules\BusinessRegistration\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\BusinessRegistration\Entities\ObjectTransaction;
use Modules\BusinessRegistration\Entities\ObjectTransactionSubCategory;
use Modules\BusinessRegistration\Http\Requests\ObjectTransactionSubCategory\StoreObjectTransactionSubCategoryRequest;
use Modules\BusinessRegistration\Http\Requests\ObjectTransactionSubCategory\UpdateObjectTransactionSubCategoryRequest;

class ObjectTransactionSubCategoryController extends Controller
{
    public function index()
    {
        $objectTransactionSubCategories = ObjectTransactionSubCategory::with('objectTransaction')->get();
        return view('businessregistration::admin.setting.objectTransactionSubCategory.index', compact('objectTransactionSubCategories'));
    }

    public function create()
    {
        $all_objectTransactions = ObjectTransaction::get();
        return view('businessregistration::admin.setting.objectTransactionSubCategory.create', compact('all_objectTransactions'));
    }

    public function store(StoreObjectTransactionSubCategoryRequest $request)
    {
        //        dd($request->all());
        ObjectTransactionSubCategory::create($request->validated());
        toast(' कारोबार गर्ने वस्तु  सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    public function show($id)
    {
        return view('businessregistration::show');
    }

    public function edit(ObjectTransactionSubCategory $objectTransactionSubCategory)
    {
        $all_objectTransactions = ObjectTransaction::get();
        return view('businessregistration::admin.setting.objectTransactionSubCategory.edit', compact('objectTransactionSubCategory', 'all_objectTransactions'));
    }

    public function update(UpdateObjectTransactionSubCategoryRequest $request, ObjectTransactionSubCategory $objectTransactionSubCategory)
    {
        $objectTransactionSubCategory->update($request->validated());
        toast('  सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.businessRegistration.setting.objectTransactionSubCategory.index'));
    }

    public function destroy(ObjectTransactionSubCategory $objectTransactionSubCategory)
    {
        $objectTransactionSubCategory->delete();
        return back();
    }
}

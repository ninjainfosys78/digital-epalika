<?php

namespace Modules\Revenue\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Revenue\Entities\RevenueCategory;
use Modules\Revenue\Http\Requests\RevenueCategory\StoreRevenueCategoryRequest;
use Modules\Revenue\Http\Requests\RevenueCategory\UpdateRevenueCategoryRequest;

class RevenueCategoryController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('revenueCategory_access');
        $revenueCategories = RevenueCategory::with('revenueCategory')->latest()->get();

        return view('revenue::admin.setting.revenue-category.index', compact('revenueCategories'));
    }

    public function create()
    {
        $this->checkAuthorization('revenueCategory_create');
        $revenueCategories = RevenueCategory::with('revenueCategories')->whereNull('revenue_category_id')->latest()->get();
        return view('revenue::admin.setting.revenue-category.create', compact('revenueCategories'));
    }

    public function store(StoreRevenueCategoryRequest $request)
    {
        $this->checkAuthorization('revenueCategory_create');

        RevenueCategory::create($request->validated());

        Cache::forget('revenueCategories');
        toast('वर्ग सफलतापूर्वक थपियो', 'success');
        return redirect()->back();
    }


    public function edit(RevenueCategory $revenueCategory)
    {
        $this->checkAuthorization('revenueCategory_edit');

        $revenueCategories = RevenueCategory::with('revenueCategories')->whereNull('revenue_category_id')->latest()->get();

        return view('revenue::admin.setting.revenue-category.edit', compact('revenueCategory', 'revenueCategories'));
    }

    public function update(UpdateRevenueCategoryRequest $request, RevenueCategory $revenueCategory)
    {
        $this->checkAuthorization('revenueCategory_edit');

        $revenueCategory->update($request->validated());
        Cache::forget('revenueCategories');
        toast('वर्ग सफलतापूर्वक सम्पादन गरियो', 'success');
        return redirect()->route('admin.revenue.setting.revenue-category.index');
    }

    public function destroy(RevenueCategory $revenueCategory)
    {
        $this->checkAuthorization('revenueCategory_delete');

        $revenueCategory->delete();
        Cache::forget('revenueCategories');
        toast('वर्ग सफलतापूर्वक हटाइयो', 'success');
        return redirect()->route('admin.revenue.setting.revenue-category.index');
    }
}

<?php

namespace Modules\Revenue\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Revenue\Entities\Revenue;
use Modules\Revenue\Entities\RevenueCategory;
use Modules\Revenue\Http\Requests\Revenue\StoreRevenueRequest;
use Modules\Revenue\Http\Requests\Revenue\UpdateRevenueRequest;

class RevenueController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('revenue_access');
        $revenues = Revenue::with('revenueCategory')->latest()->get();
        return view('revenue::admin.setting.revenue.index', compact('revenues'));
    }

    public function create()
    {
        $this->checkAuthorization('revenue_create');
        $revenueCategories = RevenueCategory::with('revenueCategories')->whereNull('revenue_category_id')->latest()->get();
        return view('revenue::admin.setting.revenue.create', compact('revenueCategories'));
    }

    public function store(StoreRevenueRequest $request)
    {
        $this->checkAuthorization('revenue_create');

        Revenue::create($request->validated() + ['user_id' => auth()->id()]);
        Cache::forget('revenues');
        toast('राजस्वको शिर्षक सफलतापुर्वक राखियो', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->back();
    }

    public function show(Revenue $revenue)
    {
        $this->checkAuthorization('revenue_access');
        return view('revenue::show');
    }

    public function edit(Revenue $revenue)
    {
        $this->checkAuthorization('revenue_edit');
        $revenueCategories = RevenueCategory::whereNull('revenue_category_id')->latest()->get();
        return view('revenue::admin.setting.revenue.edit', compact('revenue', 'revenueCategories'));
    }

    public function update(UpdateRevenueRequest $request, Revenue $revenue)
    {
        $this->checkAuthorization('revenue_edit');
        $revenue->update($request->validated());
        Cache::forget('revenues');
        toast('राजस्वको शिर्षक सम्पादन गरियो', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('admin.revenue.setting.revenue.index');
    }

    public function destroy(Revenue $revenue)
    {
        $this->checkAuthorization('revenue_delete');
        $revenue->delete();
        Cache::forget('revenues');
        toast('राजस्वको शिर्षक हटाइयो', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('admin.revenue.setting.revenue.index');
    }

    public function updateStatus(Revenue $revenue)
    {
        $this->checkAuthorization('revenue_edit');
        $revenue->update(['is_active' => !$revenue->is_active]);
        Cache::forget('revenues');
        toast('राजस्वको शिर्षक स्थिति अपडेट गरियो', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('admin.revenue.setting.revenue.index');
    }
}

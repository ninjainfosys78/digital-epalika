<?php

namespace Modules\Revenue\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Revenue\Entities\TaxPayerType;
use Modules\Revenue\Http\Requests\TaxPayerType\StoreTaxPayerTypeRequest;
use Modules\Revenue\Http\Requests\TaxPayerType\UpdateTaxPayerTypeRequest;

class TaxPayerTypeController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('taxPayerType_access');
        $taxPayerTypes = TaxPayerType::latest()->get();
        return view('revenue::admin.setting.tax-payer-type.index', compact('taxPayerTypes'));
    }

    public function create()
    {
        $this->checkAuthorization('taxPayerType_create');
        return view('revenue::admin.setting.tax-payer-type.create');
    }

    public function store(StoreTaxPayerTypeRequest $request)
    {
        $this->checkAuthorization('taxPayerType_create');

        TaxPayerType::create($request->validated() + ['user_id' => auth()->id()]);

        toast('करदाताको प्रकार सफलतापुर्वक राखियो', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->back();
    }


    public function edit(TaxPayerType $taxPayerType)
    {
        $this->checkAuthorization('taxPayerType_edit');
        return view('revenue::admin.setting.tax-payer-type.edit', compact('taxPayerType'));
    }

    public function update(UpdateTaxPayerTypeRequest $request, TaxPayerType $taxPayerType)
    {
        $this->checkAuthorization('taxPayerType_edit');

        $taxPayerType->update($request->validated());

        toast('करदाताको प्रकार सफलतापुर्वक अपडेट भयो', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('admin.revenue.setting.taxPayerType.index');
    }

    public function destroy(TaxPayerType $taxPayerType)
    {
        $this->checkAuthorization('taxPayerType_delete');

        $taxPayerType->delete();

        toast('करदाताको प्रकार सफलतापुर्वक हटाइयो', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('admin.revenue.setting.taxPayerType.index');
    }
}

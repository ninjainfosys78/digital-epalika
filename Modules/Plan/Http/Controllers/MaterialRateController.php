<?php

namespace Modules\Plan\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Settings\FiscalYear;
use Modules\Plan\Entities\Material;
use Modules\Plan\Entities\MaterialRate;
use Modules\Plan\Http\Requests\MaterialRate\StoreMaterialRateRequest;
use Modules\Plan\Http\Requests\MaterialRate\UpdateMaterialRateRequest;

class MaterialRateController extends Controller
{
    public function index()
    {
        $materialRates = MaterialRate::with(
            'material',
            'fiscalYear'
        )->get();
        return view('plan::admin.estimateSetting.materialRate.index', compact('materialRates'));
    }

    public function create()
    {
        $materials = Material::all();
        $fiscalYears = FiscalYear::all();
        return view('plan::admin.estimateSetting.materialRate.create', compact('materials', 'fiscalYears'));
    }

    public function store(StoreMaterialRateRequest $request)
    {
        MaterialRate::create($request->validated());
        toast('Material Added Successfully', 'success');
        return back();
    }

    public function show($id)
    {
        return view('plan::show');
    }

    public function edit(MaterialRate $materialRate)
    {
        $materials = Material::all();
        $fiscalYears = FiscalYear::all();
        return view('plan::admin.estimateSetting.materialRate.edit', compact('materialRate', 'materials', 'fiscalYears'));
    }

    public function update(UpdateMaterialRateRequest $request, MaterialRate $materialRate)
    {
        $materialRate->update($request->validated());
        toast('Material Updated Successfully', 'success');
        return back();
    }

    public function destroy(MaterialRate $materialRate)
    {
        $materialRate->delete();
        toast('Material Deleted Successfully', 'success');
        return back();
    }
}

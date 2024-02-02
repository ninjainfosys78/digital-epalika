<?php

namespace Modules\Plan\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Settings\FiscalYear;
use App\Models\Settings\Units\Unit;
use Modules\Plan\Entities\MaterialCollection;
use Modules\Plan\Entities\MaterialRate;
use Modules\Plan\Http\Requests\MaterialCollection\StoreMaterialCollectionRequest;
use Modules\Plan\Http\Requests\MaterialCollection\UpdateMaterialCollectionRequest;

class MaterialCollectionController extends Controller
{
    public function index()
    {
        $materialCollections = MaterialCollection::with(
            'materialRate',
            'unit',
            'fiscalYear'
        )->get();
        return view('plan::admin.estimateSetting.materialCollection.index', compact('materialCollections'));
    }

    public function create()
    {

        $units = Unit::all();
        $materialRates = MaterialRate::all();
        $fiscalYears = FiscalYear::all();
        return view('plan::admin.estimateSetting.materialCollection.create', compact('units', 'materialRates', 'fiscalYears'));
    }

    public function store(StoreMaterialCollectionRequest $request)
    {
        MaterialCollection::create($request->validated());
        toast('Material Collection Added Successfully', 'success');
        return back();
    }

    public function show($id)
    {
        return view('plan::show');
    }

    public function edit(MaterialCollection $materialCollection)
    {
        $units = Unit::all();
        $fiscalYears = FiscalYear::all();
        $materialRates = MaterialRate::all();
        $materialCollection->load('collectionResources');
        return view('plan::admin.estimateSetting.materialCollection.edit', compact('fiscalYears', 'units', 'materialRates', 'materialCollection'));
    }

    public function update(UpdateMaterialCollectionRequest $request, MaterialCollection $materialCollection)
    {
        $materialCollection->update($request->validated());
        toast('Material Collection Updated Successfully', 'success');
        return back();
    }

    public function destroy(MaterialCollection $materialCollection)
    {
        $materialCollection->delete();
        toast('Material Collection Deleted Successfully', 'success');
        return back();
    }
}

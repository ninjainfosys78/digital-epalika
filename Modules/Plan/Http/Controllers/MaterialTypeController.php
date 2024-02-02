<?php

namespace Modules\Plan\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Plan\Entities\MaterialType;
use Modules\Plan\Http\Requests\MaterialType\StoreMaterialTypeRequest;
use Modules\Plan\Http\Requests\MaterialType\UpdateMaterialTypeRequest;

class MaterialTypeController extends Controller
{
    public function index()
    {
        $materialTypes = MaterialType::all();
        return view('plan::admin.estimateSetting.materialType.index', compact('materialTypes'));
    }

    public function create()
    {
        return view('plan::admin.estimateSetting.materialType.create');
    }

    public function store(StoreMaterialTypeRequest $request)
    {
        MaterialType::create($request->validated());
        toast('Material Type Added successfully', 'success');
        return back();
    }

    public function show($id)
    {
        return view('plan::show');
    }

    public function edit(MaterialType $materialType)
    {
        return view('plan::admin.estimateSetting.materialType.edit', compact('materialType'));
    }

    public function update(UpdateMaterialTypeRequest $request, MaterialType $materialType)
    {
        $materialType->update($request->validated());
        toast('Material Type Updated successfully', 'success');
        return back();
    }

    public function destroy(MaterialType $materialType)
    {
        $materialType->delete();
        toast('Material Type Deleted successfully', 'success');
        return back();
    }
}

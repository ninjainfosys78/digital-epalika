<?php

namespace Modules\Plan\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Settings\Units\Unit;
use Modules\Plan\Entities\Material;
use Modules\Plan\Entities\MaterialType;
use Modules\Plan\Http\Requests\Material\StoreMaterialRequest;
use Modules\Plan\Http\Requests\Material\UpdateMaterialRequest;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::with('materialType', 'unit')->get();
        return view('plan::admin.estimateSetting.material.index', compact('materials'));
    }

    public function create()
    {
        $materialTypes = MaterialType::all();
        $units = Unit::all();
        return view('plan::admin.estimateSetting.material.create', compact('materialTypes', 'units'));
    }

    public function store(StoreMaterialRequest $request)
    {
        Material::create($request->validated());
        toast('Material Added Successfully', 'success');
        return back();
    }

    public function show(Material $material)
    {
        return view('plan::show');
    }

    public function edit(Material $material)
    {
        $materialTypes = MaterialType::all();
        $units = Unit::all();
        return view('plan::admin.estimateSetting.material.edit', compact('material', 'materialTypes', 'units'));
    }

    public function update(UpdateMaterialRequest $request, Material $material)
    {
        $material->update($request->validated());
        toast('Material Updated Successfully', 'success');
        return back();
    }

    public function destroy(Material $material)
    {
        $material->delete();
        toast('Material Deleted Successfully', 'success');
        return back();
    }
}

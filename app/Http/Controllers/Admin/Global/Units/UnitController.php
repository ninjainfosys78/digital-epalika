<?php

namespace App\Http\Controllers\Admin\Global\Units;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\MeasurementUnits\StoreUnitRequest;
use App\Http\Requests\Setting\MeasurementUnits\UpdateUnitRequest;
use App\Models\Settings\Units\Unit;

class UnitController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('unit_access');

        $units = Unit::with('measurementUnit', 'measurementUnit.type')->latest()->get();

        return view('admin.global.units.unit.index', compact('units'));
    }

    public function create()
    {
        $this->checkAuthorization('unit_create');

        return view('admin.global.units.unit.create');
    }

    public function store(StoreUnitRequest $request)
    {
        $this->checkAuthorization('unit_create');

        Unit::create($request->validated());
        toast('मापन एकाइ सफलतापूर्वक थपियो', 'success');

        return redirect(route('admin.global.units.unit.index'));
    }

    public function show(Unit $unit)
    {
    }

    public function edit(Unit $unit)
    {
        $this->checkAuthorization('unit_edit');

        $unit->load('measurementUnit');

        return view('admin.global.units.unit.edit', compact('unit'));
    }

    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $this->checkAuthorization('unit_edit');
        $unit->update($request->validated());

        toast('मापन एकाइ सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.global.units.unit.index'));
    }

    public function destroy(Unit $unit)
    {
        $this->checkAuthorization('unit_delete');
        $unit->delete();
        toast('मापन एकाइ सफलतापूर्वक मेटाइयो', 'success');

        return redirect(route('admin.global.units.unit.index'));
    }
}

<?php

namespace App\Http\Controllers\Admin\Global\Units;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\MeasurementUnits\StoreMeasurementUnitRequest;
use App\Http\Requests\Setting\MeasurementUnits\UpdateMeasurementUnitRequest;
use App\Models\Settings\Units\MeasurementUnit;
use App\Models\Settings\Units\Type;

class MeasurementUnitController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('MeasurementUnit_access');
        $types = Type::whereHas('measurementUnit')->withCount('measurementUnit')->latest()->get();

        return view('admin.global.units.measurementUnit.index', compact('types'));
    }

    public function create()
    {
        $this->checkAuthorization('MeasurementUnit_create');

        $types = Type::latest()->get();

        return view('admin.global.units.measurementUnit.create', compact(['types']));
    }

    public function store(StoreMeasurementUnitRequest $request)
    {
        $this->checkAuthorization('MeasurementUnit_create');

        MeasurementUnit::create($request->validated());
        toast('मापन एकाइ विविधता सफलतापूर्वक थपियो', 'success');

        return redirect(route('admin.global.units.measurementUnit.index'));
    }

    public function show(MeasurementUnit $measurementUnit)
    {
        //
    }

    public function edit(MeasurementUnit $measurementUnit)
    {
        $this->checkAuthorization('MeasurementUnit_edit');

        $types = Type::latest()->get();

        return view('admin.global.units.measurementUnit.edit', compact('measurementUnit', 'types'));
    }

    public function update(UpdateMeasurementUnitRequest $request, MeasurementUnit $measurementUnit)
    {
        $this->checkAuthorization('MeasurementUnit_edit');
        $measurementUnit->update($request->validated());

        toast('मापन एकाइ विविधता सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.global.units.measurementUnit.index'));
    }

    public function destroy(MeasurementUnit $measurementUnit)
    {
        $this->checkAuthorization('MeasurementUnit_delete');
        $measurementUnit->delete();
        toast('मापन एकाइ विविधता सफलतापूर्वक मेटाइयो', 'success');

        return redirect(route('admin.global.units.measurementUnit.index'));
    }
}

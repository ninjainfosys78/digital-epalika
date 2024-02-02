<?php

namespace Modules\Plan\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Settings\Units\Unit;
use Modules\Plan\Entities\Fuel;
use Modules\Plan\Http\Requests\Fuel\StoreFuelRequest;
use Modules\Plan\Http\Requests\Fuel\UpdateFuelRequest;

class FuelController extends Controller
{
    public function index()
    {
        $fuels = Fuel::with('unit')->get();
        return view('plan::admin.estimateSetting.fuel.index', compact('fuels'));
    }

    public function create()
    {
        $units = Unit::all();
        return view('plan::admin.estimateSetting.fuel.create', compact('units'));
    }

    public function store(StoreFuelRequest $request)
    {
        Fuel::create($request->validated());
        toast('Fuel Added Successfully', 'success');
        return back();
    }

    public function show(Fuel $fuel)
    {
        return view('plan::show');
    }

    public function edit(Fuel $fuel)
    {
        $units = Unit::all();
        return view('plan::admin.estimateSetting.fuel.edit', compact('fuel', 'units'));
    }

    public function update(UpdateFuelRequest $request, Fuel $fuel)
    {
        $fuel->update($request->validated());
        toast('Fuel Updated Successfully', 'success');
        return back();
    }

    public function destroy(Fuel $fuel)
    {
        $fuel->delete();
        toast('Fuel Deleted Successfully', 'success');
        return back();
    }
}

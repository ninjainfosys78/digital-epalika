<?php

namespace Modules\Plan\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Plan\Entities\Equipment;
use Modules\Plan\Entities\Fuel;
use Modules\Plan\Entities\FuelDemand;
use Modules\Plan\Http\Requests\FuelDemand\StoreFuelDemandRequest;
use Modules\Plan\Http\Requests\FuelDemand\UpdateFuelDemandRequest;

class FuelDemandController extends Controller
{
    public function index()
    {
        $fuelDemands =  FuelDemand::with('fuel', 'equipment')->get();
        return view('plan::admin.estimateSetting.fuelDemand.index', compact('fuelDemands'));
    }

    public function create()
    {
        $fuels = Fuel::all();
        $equipments = Equipment::all();
        return view('plan::admin.estimateSetting.fuelDemand.create', compact('fuels', 'equipments'));
    }

    public function store(StoreFuelDemandRequest $request)
    {
        FuelDemand::create($request->validated());
        toast('Fuel Demand Added successfully', 'success');
        return back();
    }

    public function show(FuelDemand $fuelDemand)
    {
        return view('plan::show');
    }

    public function edit(FuelDemand $fuelDemand)
    {
        $fuels = Fuel::all();
        $equipments = Equipment::all();
        return view('plan::admin.estimateSetting.fuelDemand.edit', compact('fuels', 'equipments', 'fuelDemand'));
    }

    public function update(UpdateFuelDemandRequest $request, FuelDemand $fuelDemand)
    {
        $fuelDemand->update($request->validated());
        toast('Fuel Demand Updated successfully', 'success');
        return back();
    }

    public function destroy(FuelDemand $fuelDemand)
    {
        $fuelDemand->delete();
        toast('Fuel Demand deleted successfully', 'success');
        return back();
    }
}

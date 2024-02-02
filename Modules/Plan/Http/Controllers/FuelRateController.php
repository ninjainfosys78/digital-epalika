<?php

namespace Modules\Plan\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Plan\Entities\Fuel;
use Modules\Plan\Entities\FuelRate;
use Modules\Plan\Http\Requests\FuelRate\StoreFuelRateRequest;
use Modules\Plan\Http\Requests\FuelRate\UpdateFuelRateRequest;

class FuelRateController extends Controller
{
    public function index()
    {

        $fuelRates = FuelRate::with('fuel')->get();
        return view('plan::admin.estimateSetting.fuelRate.index', compact('fuelRates'));
    }

    public function create()
    {
        $fuels = Fuel::all();
        return view('plan::admin.estimateSetting.fuelRate.create', compact('fuels'));
    }

    public function store(StoreFuelRateRequest $request)
    {
        FuelRate::create($request->validated());
        toast('Fuel Added Successfully', 'success');
        return back();
    }

    public function show($id)
    {
        return view('plan::show');
    }

    public function edit(FuelRate $fuelRate)
    {
        $fuels = Fuel::all();
        return view('plan::admin.estimateSetting.fuelRate.edit', compact('fuelRate', 'fuels'));
    }

    public function update(UpdateFuelRateRequest $request, FuelRate $fuelRate)
    {
        $fuelRate->update($request->validated());
        toast('Fuel Rate Updated Successfully', 'success');
        return back();
    }

    public function destroy(FuelRate $fuelRate)
    {
        $fuelRate->delete();
        toast('Fuel Rate Deleted Successfully', 'success');
        return back();
    }
}

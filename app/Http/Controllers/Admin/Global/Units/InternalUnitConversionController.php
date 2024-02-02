<?php

namespace App\Http\Controllers\Admin\Global\Units;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\MeasurementUnits\StoreUnitConversionRequest;
use App\Models\Settings\Units\Unit;
use App\Models\Settings\Units\UnitConversion;

class InternalUnitConversionController extends Controller
{
    public function index(Unit $unit)
    {
        $this->checkAuthorization('unit_access');

        $conversionUnits = Unit::where('measurement_unit_id', $unit->measurement_unit_id)->get();
        $conversions = UnitConversion::where('conversion_from', $unit->id)->get();

        return view('admin.global.units.unit.conversion.internal.index', compact('unit', 'conversionUnits', 'conversions'));
    }

    public function store(StoreUnitConversionRequest $request, Unit $unit)
    {
        foreach ($request->input('conversion') as $conversion) {
            if ($conversionData = UnitConversion::where('conversion_to', $conversion['conversion_to'])->where('conversion_from', $unit->id)->first()) {
                $conversionData->update(['rate' => $conversion['rate'] ?? '']);
            } else {
                UnitConversion::create($conversion + [
                    'conversion_from' => $unit->id,
                ]);
            }
        }

        toast('मापन एकाइ रुपान्तरण सफलतापूर्वक थपियो', 'success');

        return redirect(route('admin.global.units.unit.index'));
    }
}

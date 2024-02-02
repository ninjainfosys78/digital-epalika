<?php

namespace App\Http\Controllers\Admin\Global\Units;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExternalUnitConversionRequest;
use App\Models\Settings\Units\Unit;
use App\Models\Settings\Units\UnitConversion;

class ExternalUnitConversionController extends Controller
{
    public function index(Unit $unit)
    {
        $this->checkAuthorization('unit_access');

        $conversionUnits = Unit::where('type_id', $unit->type_id)
            ->where('is_smallest', 1)
            ->get();
        $conversions = UnitConversion::where('conversion_from', $unit->id)->get();

        return view('admin.global.units.unit.conversion.external.index', compact('unit', 'conversionUnits', 'conversions'));
    }

    public function store(StoreExternalUnitConversionRequest $request, Unit $unit)
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

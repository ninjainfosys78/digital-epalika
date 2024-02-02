<?php

namespace Modules\Plan\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Settings\FiscalYear;
use App\Models\Settings\Units\Unit;
use Modules\Plan\Entities\Equipment;
use Modules\Plan\Entities\EquipmentAdditionalCost;
use Modules\Plan\Http\Requests\EquipmentAdditionalCost\StoreEquipmentAdditionalCostRequest;
use Modules\Plan\Http\Requests\EquipmentAdditionalCost\UpdateEquipmentAdditionalCostRequest;

class EquipmentAdditionalCostController extends Controller
{
    public function index()
    {
        $equipments = Equipment::get();
        return view('plan::admin.estimateSetting.equipmentAdditionalCost.index', compact('equipments'));
    }

    public function create()
    {
        $fiscalYears = FiscalYear::all();
        $units = Unit::all();
        $equipments = Equipment::all();
        return view('plan::admin.estimateSetting.equipmentAdditionalCost.create', compact('fiscalYears', 'units', 'equipments'));
    }

    public function store(StoreEquipmentAdditionalCostRequest $request)
    {
        EquipmentAdditionalCost::create($request->validated());
        toast('Equipment Additional Cost Added Successfully', 'success');
        return back();
    }

    public function show(EquipmentAdditionalCost $equipmentAdditionalCost)
    {
        return view('plan::show');
    }

    public function edit(Equipment $equipment)
    {
        $equipment->load('equipmentAdditionalCosts', 'fuelDemands', 'crewRates');
        return view('plan::admin.estimateSetting.equipmentAdditionalCost.edit', compact('equipment'));
    }

    public function update(UpdateEquipmentAdditionalCostRequest $request, EquipmentAdditionalCost $equipmentAdditionalCost)
    {
        $equipmentAdditionalCost->update($request->validated());
        toast('Equipment Additional Cost Updated Successfully', 'success');
        return back();
    }

    public function destroy(EquipmentAdditionalCost $equipmentAdditionalCost)
    {
        $equipmentAdditionalCost->delete();
        toast('Equipment Additional Cost Deleted Successfully', 'success');
        return back();
    }
}

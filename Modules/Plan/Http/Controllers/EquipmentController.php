<?php

namespace Modules\Plan\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Plan\Entities\Equipment;
use Modules\Plan\Http\Requests\Equipment\StoreEquipmentRequest;
use Modules\Plan\Http\Requests\Equipment\UpdateEquipmentRequest;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::all();
        return view('plan::admin.estimateSetting.equipment.index', compact('equipments'));
    }

    public function create()
    {
        return view('plan::admin.estimateSetting.equipment.create');
    }

    public function store(StoreEquipmentRequest $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'activity' => ['required', 'string', 'max:255'],
            'is_used_for_transport' => ['required', 'boolean'],
            'capacity' => ['required'],
            'er' => ['nullable'],
            'gr' => ['nullable'],
            'bt' => ['nullable']
        ]);
        $er = $request->input('er') ?? 0;
        $gr = $request->input('gr') ?? 0;
        $bt = $request->input('bt') ?? 0;
        Equipment::create([
            'title' => $request->input('title'),
            'activity' => $request->input('activity'),
            'is_used_for_transport' => $request->input('is_used_for_transport'),
            'capacity' => $request->input('capacity'),
            'speed_with_out_load' => implode(',', [$er, $gr, $bt]),
        ]);

        toast('Equipment Added Successfully', 'success');
        return back();
    }

    public function show(Equipment $equipment)
    {
        return view('plan::show');
    }

    public function edit(Equipment $equipment)
    {
        $values = explode(',', $equipment->speed_with_out_load);
        return view('plan::admin.estimateSetting.equipment.edit', compact('equipment', 'values'));
    }

    public function update(UpdateEquipmentRequest $request, Equipment $equipment)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'activity' => ['required', 'string', 'max:255'],
            'is_used_for_transport' => ['required', 'boolean'],
            'capacity' => ['required'],
            'er' => ['nullable'],
            'gr' => ['nullable'],
            'bt' => ['nullable']
        ]);
        $er = $request->input('er') ?? 0;
        $gr = $request->input('gr') ?? 0;
        $bt = $request->input('bt') ?? 0;
        $equipment->update([
            'title' => $request->input('title'),
            'activity' => $request->input('activity'),
            'is_used_for_transport' => $request->input('is_used_for_transport'),
            'capacity' => $request->input('capacity'),
            'speed_with_out_load' => implode(',', [$er, $gr, $bt]),
        ]);

        toast('Equipment Updated Successfully', 'success');
        return back();
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        toast('Equipment Deleted Successfully', 'success');
        return back();
    }
}

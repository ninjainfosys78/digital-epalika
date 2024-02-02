<?php

namespace Modules\Plan\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Plan\Entities\CrewRate;
use Modules\Plan\Entities\Equipment;
use Modules\Plan\Entities\Labour;
use Modules\Plan\Http\Requests\CrewRate\StoreCrewRateRequest;
use Modules\Plan\Http\Requests\CrewRate\UpdateCrewRateRequest;

class CrewRateController extends Controller
{
    public function index()
    {
        $crewRates = CrewRate::with(
            'labour',
            'equipment'
        )->get();
        return view('plan::admin.estimateSetting.crewRate.index', compact('crewRates'));
    }

    public function create()
    {
        $labours = Labour::all();
        $equipments = Equipment::all();
        return view('plan::admin.estimateSetting.crewRate.create', compact('labours', 'equipments'));
    }

    public function store(StoreCrewRateRequest $request)
    {
        CrewRate::create($request->validated());
        toast('Crew Rate Added Successfully', 'success');
        return back();
    }

    public function show(CrewRate $crewRate)
    {
        return view('plan::show');
    }

    public function edit(CrewRate $crewRate)
    {
        $labours = Labour::all();
        $equipments = Equipment::all();
        return view('plan::admin.estimateSetting.crewRate.edit', compact('labours', 'equipments', 'crewRate'));
    }

    public function update(UpdateCrewRateRequest $request, CrewRate $crewRate)
    {
        $crewRate->update($request->validated());
        toast('Crew Rate Updated Successfully', 'success');
        return back();
    }

    public function destroy(CrewRate $crewRate)
    {
        $crewRate->delete();
        toast('Crew Rate Deleted Successfully', 'success');
        return back();
    }
}

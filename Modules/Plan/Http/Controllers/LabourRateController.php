<?php

namespace Modules\Plan\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Settings\FiscalYear;
use Modules\Plan\Entities\Labour;
use Modules\Plan\Entities\LabourRate;
use Modules\Plan\Http\Requests\LabourRate\StoreLabourRateRequest;
use Modules\Plan\Http\Requests\LabourRate\UpdateLabourRateRequest;

class LabourRateController extends Controller
{
    public function index()
    {
        $labourRates = LabourRate::with('labour')->get();
        return view('plan::admin.estimateSetting.labourRate.index', compact('labourRates'));
    }

    public function create()
    {
        $labours = Labour::get();
        $fiscalYears = FiscalYear::all();
        return view('plan::admin.estimateSetting.labourRate.create', compact('labours', 'fiscalYears'));
    }

    public function store(StoreLabourRateRequest $request)
    {
        LabourRate::create($request->validated());
        toast('Labour Rate Store Successfully', 'success');
        return back();
    }

    public function show(LabourRate $labourRate)
    {
        return view('plan::show');
    }

    public function edit(LabourRate $labourRate)
    {
        $labours = Labour::get();
        $fiscalYears = FiscalYear::all();
        return view('plan::admin.estimateSetting.labourRate.edit', compact('labourRate', 'labours', 'fiscalYears'));
    }

    public function update(UpdateLabourRateRequest $request, LabourRate $labourRate)
    {
        $labourRate->update($request->validated());
        toast('Labour Rate Updated Successfully', 'success');
        return back();
    }

    public function destroy(LabourRate $labourRate)
    {
        $labourRate->delete();
        toast('Labour Rate Deleted Successfully', 'success');
        return back();
    }
}

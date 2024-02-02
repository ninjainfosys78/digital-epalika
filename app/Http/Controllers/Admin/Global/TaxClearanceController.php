<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\EMap\Entities\TaxClearance;
use Modules\EMap\Http\Requests\TaxClearance\StoreTaxClearanceRequest;
use Modules\EMap\Http\Requests\TaxClearance\UpdateTaxClearanceRequest;

class TaxClearanceController extends Controller
{
    public function index()
    {
        $taxClearances = TaxClearance::where('organization_detail_id', auth('organization')
            ->user()->organizationDetail->id)
            ->latest()
            ->get();

        return view('admin.global.organization.tax-clearance.index', compact('taxClearances'));
    }

    public function create()
    {
        return view('admin.global.organization.tax-clearance.create');
    }

    public function store(StoreTaxClearanceRequest $request)
    {
        TaxClearance::create($request->validated() + [
            'organization_detail_id' => auth('organization')->user()->organizationDetail->id,
        ]);

        toast('कर चुक्ता सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function show(TaxClearance $taxClearance)
    {
        return view('emap::show');
    }

    public function edit(TaxClearance $taxClearance)
    {
        return view('admin.global.organization.tax-clearance.edit', compact('taxClearance'));
    }

    public function update(UpdateTaxClearanceRequest $request, TaxClearance $taxClearance)
    {
        $taxClearance->update($request->validated());
        toast('कर चुक्ता सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.global.taxClearance.index'));
    }

    public function destroy(TaxClearance $taxClearance)
    {
        $taxClearance->delete();
        toast(' सफलतापूर्वक मेटियो', 'success');

        return back();
    }
}

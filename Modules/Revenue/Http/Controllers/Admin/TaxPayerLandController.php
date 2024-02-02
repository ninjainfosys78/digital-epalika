<?php

namespace Modules\Revenue\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Revenue\Entities\TaxPayer;
use Modules\Revenue\Entities\TaxPayerLand;

class TaxPayerLandController extends Controller
{
    public function index(TaxPayer $taxPayer)
    {
        $this->checkAuthorization('taxPayerLand_access');
        $taxPayer->load('taxPayerLands');

        return view('revenue::admin.tax-payer.land.index', compact('taxPayer'));
    }

    public function create(TaxPayer $taxPayer)
    {
        $this->checkAuthorization('taxPayerLand_access');
        return view('revenue::admin.tax-payer.land.create', compact('taxPayer'));
    }

    public function store(Request $request)
    {
        $this->checkAuthorization('taxPayerLand_access');
        //
    }

    public function show(TaxPayerLand $taxPayerLand)
    {
        $this->checkAuthorization('taxPayerLand_access');
        return view('revenue::show');
    }

    public function edit(TaxPayerLand $taxPayerLand)
    {
        $this->checkAuthorization('taxPayerLand_access');
        return view('revenue::edit');
    }

    public function update(Request $request, TaxPayerLand $taxPayerLand)
    {
        $this->checkAuthorization('taxPayerLand_access');
        //
    }

    public function destroy(TaxPayerLand $taxPayerLand)
    {
        $this->checkAuthorization('taxPayerLand_access');
        //
    }
}

<?php

namespace Modules\EMap\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\EMap\Entities\MapFee;
use Modules\EMap\Entities\MapSetting;
use Modules\EMap\Http\Requests\MapFee\StoreMapFeeRequest;
use Modules\EMap\Http\Requests\MapFee\UpdateMapFeeRequest;

class MapFeeController extends Controller
{
    public function index()
    {
        $this->checkAuthorization(
            'mapFee_access'
        );

        $mapFees = MapFee::with('unit')->get();

        return view('emap::admin.map_fee.index', compact('mapFees'));
    }

    public function create()
    {
        $this->checkAuthorization('mapFee_create');

        return view('emap::admin.map_fee.create');
    }

    public function store(StoreMapFeeRequest $request)
    {
        $this->checkAuthorization('mapFee_create');

        MapFee::create($request->validated() + [
            'unit_id' => MapSetting::first()
            ->land_measurement_standard_id,
        ]);

        toast('नक्सा शुल्क सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function show(MapFee $mapFee)
    {
        $this->checkAuthorization('mapFee_access');

        return view('emap::show');
    }

    public function edit(MapFee $mapFee)
    {
        $this->checkAuthorization('mapFee_edit');

        return view('emap::admin.map_fee.edit', compact('mapFee'));
    }

    public function update(UpdateMapFeeRequest $request, MapFee $mapFee)
    {
        $this->checkAuthorization('mapFee_edit');

        $mapFee->update($request->validated() + [
            'unit_id' => MapSetting::first()->land_measurement_standard_id,
        ]);

        toast('नक्सा शुल्क सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('emap.admin.mapFee.index'));
    }

    public function destroy(MapFee $mapFee)
    {
        $this->checkAuthorization('mapFee_delete');

        $mapFee->delete();

        toast('नक्सा शुल्क सफलतापूर्वक मेटाइयो', 'success');

        return back();
    }
}

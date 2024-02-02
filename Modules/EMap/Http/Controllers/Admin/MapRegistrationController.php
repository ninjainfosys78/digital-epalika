<?php

namespace Modules\EMap\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Entities\MapRegistration;
use Modules\EMap\Entities\MapRegistrationParticular;
use Modules\EMap\Http\Requests\MapRegistration\StoreMapRegistrationRequest;
use Modules\EMap\Http\Requests\MapRegistration\UpdateMapRegistrationRequest;

class MapRegistrationController extends Controller
{
    public function index(MapApply $mapApply)
    {
        $mapApply->load('mapRegistration');
        if (!$mapApply->mapRegistration) {
            return redirect(route('emap.admin.mapApply.mapRegistration.create', $mapApply));
        }
        return view('emap::admin.map.map-registration.index', compact('mapApply'));
    }
    public function create(MapApply $mapApply)
    {
        $mapApply->load(['storeyDetails', 'storeyDetails.mapFee']);

        return view('emap::admin.map.map-registration.create', compact('mapApply'));
    }

    public function store(StoreMapRegistrationRequest $request, MapApply $mapApply): RedirectResponse
    {
        DB::transaction(function () use ($request, $mapApply) {
            $mapRegistration = MapRegistration::updateOrCreate(
                ['map_apply_id' => $mapApply->id],
                $request->validated()
            );

            if ($mapRegistration->wasRecentlyCreated) {
                $mapApply->update([
                    'registration_date' => now(),
                    'registration_no' => MapApply::whereFiscalYearId($mapApply->fiscal_year_id)->max('registration_no') + 1,
                ]);
            }
        });

        toast('दस्तुर तथा दर्ता सफलतापूर्वक थपियो', 'success');

        return redirect(route('emap.admin.mapApply.mapRegistration.index', $mapApply));
    }

    public function edit(MapApply $mapApply, MapRegistration $mapRegistration)
    {
        return view('emap::admin.map.map-registration.edit', compact('mapApply', 'mapRegistration'));
    }

    public function update(UpdateMapRegistrationRequest $request, MapApply $mapApply, MapRegistration $mapRegistration): RedirectResponse
    {
        DB::transaction(function () use ($request, $mapRegistration) {
            $mapRegistration->update($request->validated());

            if (!empty($request->input('particulars'))) {
                foreach ($request->input('particulars') as $particular) {
                    if ($particular['id']) {
                        MapRegistrationParticular::find($particular['id'])?->update($particular);
                    } else {
                        $mapRegistration->mapRegistrationParticulars()->create($particular);
                    }
                }
            }
        });

        toast('दस्तुर तथा दर्ता सफलतापूर्वक अपडेट भयो', 'success');

        return back();
    }
}

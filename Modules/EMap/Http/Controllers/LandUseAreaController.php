<?php

namespace Modules\EMap\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\EMap\Entities\LandUseArea;
use Modules\EMap\Http\Requests\LandUseArea\StoreLandUseAreaRequest;
use Modules\EMap\Http\Requests\LandUseArea\UpdateLandUseAreaRequest;

class LandUseAreaController extends Controller
{
    public function index()
    {
        $landUseAreas = LandUseArea::latest()->get();
        return view('emap::admin.land_use_area.index', compact('landUseAreas'));
    }

    public function create()
    {
        return view('emap::admin.land_use_area.create');
    }

    public function store(StoreLandUseAreaRequest $request)
    {
        LandUseArea::create($request->validated());
        toast('भूउपयोग क्षेत्र थपियो', 'success');
        return back();
    }

    public function show($id)
    {

    }

    public function edit(LandUseArea $landUseArea)
    {
        return view('emap::admin.land_use_area.edit', compact('landUseArea'));
    }

    public function update(UpdateLandUseAreaRequest $request, LandUseArea $landUseArea)
    {
        $landUseArea->update($request->validated());
        toast('भूउपयोग क्षेत्र सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('emap.admin.landUseArea.index'));
    }

    public function destroy(LandUseArea $landUseArea)
    {
        $landUseArea->delete();
        toast('भूउपयोग क्षेत्र मेटियो', 'success');
        return back();
    }
}

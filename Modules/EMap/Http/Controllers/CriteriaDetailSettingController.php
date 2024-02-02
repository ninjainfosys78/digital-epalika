<?php

namespace Modules\EMap\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\EMap\Entities\CriteriaDetailSetting;
use Modules\EMap\Entities\LandUseArea;
use Modules\EMap\Http\Requests\CriteriaDetailSetting\StoreCriteriaDetailSettingRequest;
use Modules\EMap\Http\Requests\CriteriaDetailSetting\UpdateCriteriaDetailSettingRequest;

class CriteriaDetailSettingController extends Controller
{
    public function index()
    {
        $criteriaDetailSettings = CriteriaDetailSetting::latest()->get();
        return view('emap::admin.criteriaDetailSetting.index', compact('criteriaDetailSettings'));
    }

    public function create()
    {
        $landUseAreas = LandUseArea::all();
        return view('emap::admin.criteriaDetailSetting.create', compact('landUseAreas'));
    }

    public function store(StoreCriteriaDetailSettingRequest $request)
    {
        CriteriaDetailSetting::create($request->validated());
        toast('मापदण्ड थपियो', 'success');
        return back();
    }

    public function show($id)
    {
        return view('emap::show');
    }

    public function edit(CriteriaDetailSetting $criteriaDetailSetting)
    {
        $landUseAreas = LandUseArea::all();
        return view('emap::admin.criteriaDetailSetting.edit', compact('criteriaDetailSetting', 'landUseAreas'));
    }

    public function update(UpdateCriteriaDetailSettingRequest $request, CriteriaDetailSetting $criteriaDetailSetting)
    {
        $criteriaDetailSetting->update($request->validated());
        toast('मापदण्ड सम्पादन गरियो', 'success');
        return back();
    }

    public function destroy(CriteriaDetailSetting $criteriaDetailSetting)
    {
        $criteriaDetailSetting->delete();
        toast('मापदण्ड हटाइयो', 'success');
        return back();
    }
}

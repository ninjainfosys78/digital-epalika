<?php

namespace Modules\EMap\Http\Controllers\Admin\Api;

use App\Models\Settings\OfficeSetting;
use App\Notifications\MapApplyNotification;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\EMap\Entities\LandUseArea;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Entities\MapFee;
use Modules\EMap\Entities\MapSetting;
use Modules\EMap\Entities\Organization;
use Modules\EMap\Entities\StructureType;
use Modules\EMap\Enums\ApplicantTypeEnum;
use Modules\EMap\Enums\ApplicationFormTypeEnum;
use Modules\EMap\Enums\BuildingUsageEnum;
use Modules\EMap\Enums\LandOwnerTypeEnum;
use Modules\EMap\Enums\RelationEnum;
use Modules\EMap\Enums\TypeOfConstructionWorkEnum;
use Modules\EMap\Http\Requests\MapApplyForm\StoreMapApplyFormRequest;
use Modules\EMap\Transformers\MapApplyResource;
use Modules\Plan\Transformers\LandUseAreaResource;
use Modules\Plan\Transformers\MapFeeResource;
use Modules\Plan\Transformers\OrganizationResource;
use Modules\Plan\Transformers\SettingResource;
use Modules\Plan\Transformers\StructureTypeResource;
use Illuminate\Support\Facades\Notification;

class MapApplyFormApiController extends Controller
{
    public function getMapApplySetting(): array
    {
        return [
            'setting' => SettingResource::make(MapSetting::with('landMeasurement', 'standardLandMeasurement')->first()),
            'organizations' => OrganizationResource::collection(Organization::with('organizationDetail')->get()),
            'mapFees' => MapFeeResource::collection(MapFee::with('unit')->get()),
            'landUseAreas' => LandUseAreaResource::collection(LandUseArea::all()),
            'structureTypes' => StructureTypeResource::collection(StructureType::get()),
            'allDistricts' => get_districts(),
            'constructionTypes' => TypeOfConstructionWorkEnum::getValuesWithLabels(),
            'buildingUsages' => BuildingUsageEnum::getValuesWithLabels(),
            'applicationForms' => ApplicationFormTypeEnum::getValuesWithLabels(),
            'ownerTypes' => LandOwnerTypeEnum::getValuesWithLabels(),
            'applicantTypes' => ApplicantTypeEnum::getValuesWithLabels(),
            'relation_with_owner' => RelationEnum::getValuesWithLabels()
        ];
    }


    public function store(StoreMapApplyFormRequest $request)
    {
        $data = DB::transaction(function () use ($request) {

            $mapApply = MapApply::create($request->validated() + [
                    'fiscal_year_id' => OfficeSetting::first()->fiscal_year_id,
                    'mobile_user_id' => auth()->id()
                ]);


            $mapApply->landDetail()
                ->create($request->validated()['landDetail'] + [
                        'unit_id' => MapSetting::first()->land_measurement_standard_id ?? null,
                    ]);

            $mapApply->houseOwner()->create($request->validated()['houseOwner']);

            $mapApply->landOwner()->create($request->validated()['landOwner']);

            $mapApply->applicantDetail()->create($request->validated()['applicantDetail']);

            //            Notification::send($mapApply->organization, new MapApplyNotification($mapApply));

            return $mapApply;
        });
        return response()->json([
            'message' => 'Map Applied Successfully'
        ], 201);
    }

    public function registeredMap()
    {
        return MapApplyResource::collection(auth()->user()?->load('mapApplies.houseOwner')?->mapApplies);
    }
}

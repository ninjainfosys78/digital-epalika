<?php

namespace Modules\EMap\Http\Controllers\Api;

use App\Models\Settings\OfficeSetting;
use App\Notifications\MapApplyNotification;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Entities\MapSetting;
use Modules\EMap\Http\Requests\Api\MapApplicationRequest;
use Modules\EMap\Transformers\MapApplyResource;

class MapApplicationController extends Controller
{
    public function registerApplication(MapApplicationRequest $request)
    {
        $mapApply = DB::transaction(function () use ($request) {
            $mapApply = MapApply::create($request->validated() + [
                    'fiscal_year_id' => OfficeSetting::first()->fiscal_year_id,
                    'sent_to_organization' => 'pending'
                ]);

            $mapApply->landDetail()->create($request->validated('landDetail') + [
                    'unit_id' => MapSetting::first()->land_measurement_standard_id ?? null,
                ]);

            $mapApply->houseOwner()->create($request->validated('houseOwner'));

            $mapApply->landOwner()->create($request->validated('landOwner'));

            $mapApply->applicantDetail()->create($request->validated('applicantDetail'));

            Notification::send($mapApply->organization, new MapApplyNotification($mapApply));

            return $mapApply;
        });
        return response()->json([
            'message' => 'Map Applied Successfully',
            'data' => MapApplyResource::make($mapApply)
        ], 201);
    }
}

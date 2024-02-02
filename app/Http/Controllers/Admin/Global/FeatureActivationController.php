<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Models\FeatureActivation;
use Illuminate\Support\Facades\DB;

class FeatureActivationController extends Controller
{
    public function showFeatureActivationPage()
    {
        $this->checkAuthorization('feature_access');

        $featureActivations = FeatureActivation::get()->groupBy(function ($feature) {
            return $feature->getRawOriginal('feature_type');
        });

        return view('admin.global.feature.index', compact('featureActivations'));
    }

    public function updateFeatureActivation(FeatureActivation $featureActivation)
    {
        $this->checkAuthorization('feature_access');

        DB::transaction(function () use ($featureActivation) {
            FeatureActivation::where('feature_type', $featureActivation->feature_type)
                ->where('id', '!=', $featureActivation->id)
                ->update([
                    'feature_status' => 0
                ]);

            $featureActivation->update([
                'feature_status' => !$featureActivation->feature_status
            ]);

            \Cache::forget('settings');
        });

        toast('Featured Updated Successfully', 'success');
        return back();
    }
}

<?php

namespace App\Observers;

use App\Models\FeatureActivation;

class FeatureActivationObserver
{
    public function updating(FeatureActivation $featureActivation): void
    {
        //        if ($featureActivation->isDirty('feature_status')) {
        //            return;
        //        }
        //
        //        $otherFeatures = FeatureActivation::where('feature_type', $featureActivation->feature_type->value)
        //            ->where('feature_status', 1)
        //            ->where('id', '!=', $featureActivation->id)
        //            ->get();
        //
        //        foreach ($otherFeatures as $otherFeature) {
        //            $otherFeature->feature_status = 0;
        //            $otherFeature->saveQuietly();
        //        }
    }
}

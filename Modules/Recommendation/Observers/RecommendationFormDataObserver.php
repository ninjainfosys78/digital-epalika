<?php

namespace Modules\Recommendation\Observers;

use Modules\Recommendation\Entities\RecommendationFormData;

class RecommendationFormDataObserver
{
    public function updating(RecommendationFormData $recommendationFormData)
    {
        $recommendationFormData->update_times = $recommendationFormData->update_times++;
    }
}

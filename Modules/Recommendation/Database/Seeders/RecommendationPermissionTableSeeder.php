<?php

namespace Modules\Recommendation\Database\Seeders;

use App\Traits\StorePermissionTrait;
use Illuminate\Database\Seeder;

class RecommendationPermissionTableSeeder extends Seeder
{
    use StorePermissionTrait;

    public function run()
    {
        $permissions = [
            'recommendationDashboard_access',
            'recommendationTemplate_access',
            'recommendationTemplate_create',
            'recommendationTemplate_edit',
            'recommendationTemplate_delete',
            'recommendationCategory_access',
            'recommendationCategory_create',
            'recommendationCategory_edit',
            'recommendationCategory_delete',
            'recommendation_access',
            'recommendation_create',
            'recommendation_edit',
            'recommendation_delete',
            'personalDetail_access',
            'personalDetail_create',
            'personalDetail_edit',
            'personalDetail_delete',
            'recommendationReport_main',
            'recommendationReport_ward',
            'recommendationReport_recommendationCategory',
            'recommendationReport_personalDetail',
            'recommendationSetting_access',
            'recommendationSetting_edit',
            'recommendationSubCategory_access',
            'recommendationSubCategory_edit',
            'recommendationSubCategory_create',
            'recommendationSubCategory_delete'

        ];

        $this->storePermission($permissions);
    }
}

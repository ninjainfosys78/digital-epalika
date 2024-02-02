<?php

namespace Modules\Revenue\Database\Seeders;

use App\Traits\StorePermissionTrait;
use Illuminate\Database\Seeder;

class RevenuePermissionSeeder extends Seeder
{
    use StorePermissionTrait;

    public function run()
    {
        $permissions = [
            'revenueDashboard_access',
            'invoice_access',
            'invoice_create',
            'invoice_edit',
            'invoice_delete',
            'revenue_access',
            'revenue_create',
            'revenue_edit',
            'revenue_delete',
            'taxPayer_access',
            'taxPayer_create',
            'taxPayer_edit',
            'taxPayer_delete',
            'taxPayerLand_access',
            'taxPayerLand_create',
            'taxPayerLand_edit',
            'taxPayerLand_delete',
            'taxPayerType_access',
            'taxPayerType_create',
            'taxPayerType_edit',
            'taxPayerType_delete',
            'revenueCategory_access',
            'revenueCategory_create',
            'revenueCategory_edit',
            'revenueCategory_delete',
            'sector_access',
            'sector_create',
            'sector_edit',
            'sector_delete',
            'place_access',
            'place_create',
            'place_edit',
            'place_delete',
            'physicalStructureType_access',
            'physicalStructureType_create',
            'physicalStructureType_edit',
            'physicalStructureType_delete',
            'structureAssessmentRate_access',
            'structureAssessmentRate_create',
            'structureAssessmentRate_edit',
            'structureAssessmentRate_delete',
            'revenueSetting_access',
            'revenueSetting_create',
        ];

        $this->storePermission($permissions);
    }
}

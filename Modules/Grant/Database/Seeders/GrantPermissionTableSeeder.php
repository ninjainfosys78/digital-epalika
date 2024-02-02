<?php

namespace Modules\Grant\Database\Seeders;

use App\Traits\StorePermissionTrait;
use Illuminate\Database\Seeder;

class GrantPermissionTableSeeder extends Seeder
{
    use StorePermissionTrait;

    public function run()
    {
        $permissions = [
            'grantDashboard_access',
            'grantType_access',
            'grantType_create',
            'grantType_edit',
            'grantType_delete',
            'cooperativeType_access',
            'cooperativeType_create',
            'cooperativeType_edit',
            'cooperativeType_delete',
            'affiliation_access',
            'affiliation_create',
            'affiliation_edit',
            'affiliation_delete',
            'enterpriseType_access',
            'enterpriseType_create',
            'enterpriseType_edit',
            'enterpriseType_delete',
            'grantProgram_access',
            'grantProgram_create',
            'grantProgram_edit',
            'grantProgram_delete',
            'grantOffice_access',
            'grantOffice_create',
            'grantOffice_edit',
            'grantOffice_delete',
            'farmer_access',
            'farmer_create',
            'farmer_edit',
            'farmer_delete',
            'cooperative_access',
            'cooperative_create',
            'cooperative_edit',
            'cooperative_delete',
            'group_access',
            'group_create',
            'group_edit',
            'group_delete',
            'enterprise_access',
            'enterprise_create',
            'enterprise_edit',
            'enterprise_delete',
            'grant_access',
            'grant_create',
            'grant_edit',
            'grant_delete',
            'grantDetail_access',
            'grantDetail_create',
            'grantDetail_edit',
            'grantDetail_delete',
            'farmerReport_access',
            'grantReport_access',
            'groupReport_access',
            'enterpriseReport_access',
            'cooperativeReport_access'
        ];

        $this->storePermission($permissions);
    }
}

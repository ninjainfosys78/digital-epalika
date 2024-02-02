<?php

namespace Modules\Identity\Database\Seeders;

use App\Traits\StorePermissionTrait;
use Illuminate\Database\Seeder;

class IdentityPermissionTableSeeder extends Seeder
{
    use StorePermissionTrait;

    public function run()
    {
        $permissions = [
            'identityDashboard_access',
            'disabilityReason_access',
            'disabilityReason_create',
            'disabilityReason_edit',
            'disabilityReason_delete',
            'disabilityType_access',
            'disabilityType_create',
            'disabilityType_edit',
            'disabilityType_delete',
            'cardColor_access',
            'cardColor_create',
            'cardColor_edit',
            'cardColor_delete',
            'governmentalDisabilityType_access',
            'governmentalDisabilityType_create',
            'governmentalDisabilityType_edit',
            'governmentalDisabilityType_delete',
            'employeeSignature_access',
            'employeeSignature_create',
            'employeeSignature_edit',
            'employeeSignature_delete',
            'hospital_access',
            'hospital_create',
            'hospital_edit',
            'hospital_delete',
            'disabilityCommittee_access',
            'disabilityCommittee_create',
            'disabilityCommittee_edit',
            'disabilityCommittee_delete',
        ];

        $this->storePermission($permissions);
    }
}

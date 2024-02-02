<?php

namespace Modules\Plan\Database\Seeders;

use App\Traits\StorePermissionTrait;
use Illuminate\Database\Seeder;

class PlanPermissionTableSeeder extends Seeder
{
    use StorePermissionTrait;

    public function run()
    {
        $permissions = [
            'planDashboard_access',
            'planArea_access',
            'planArea_create',
            'planArea_edit',
            'planArea_delete',
            'planLevel_access',
            'planLevel_create',
            'planLevel_edit',
            'planLevel_delete',
            'budgetHead_access',
            'budgetHead_create',
            'budgetHead_edit',
            'budgetHead_delete',
            'expenseHead_access',
            'expenseHead_create',
            'expenseHead_edit',
            'expenseHead_delete',
            'planTemplate_access',
            'planTemplate_create',
            'planTemplate_edit',
            'planTemplate_delete',
            'project_access',
            'project_create',
            'project_edit',
            'project_delete',
            'projectDocument_access',
            'projectDocument_create',
            'projectDocument_edit',
            'projectDocument_delete',
            'technicalCostEstimate_access',
            'technicalCostEstimate_create',
            'technicalCostEstimate_edit',
            'technicalCostEstimate_delete',
            'projectDeadlineExtension_access',
            'projectDeadlineExtension_create',
            'projectDeadlineExtension_edit',
            'projectDeadlineExtension_delete',
        ];

        $this->storePermission($permissions);
    }
}

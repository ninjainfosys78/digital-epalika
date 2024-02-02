<?php

namespace Modules\Roaster\Database\Seeders;

use App\Traits\StorePermissionTrait;
use Illuminate\Database\Seeder;

class RoasterPermissionTableSeeder extends Seeder
{
    use StorePermissionTrait;

    public function run()
    {
        $permissions = [
            'roasterDashboard_access',
            'department_access',
            'department_create',
            'department_edit',
            'department_delete',
            'designation_access',
            'designation_create',
            'designation_edit',
            'designation_delete',
            'subject_access',
            'subject_create',
            'subject_edit',
            'subject_delete',
            'trainer_access',
            'trainer_create',
            'trainer_edit',
            'trainer_delete',
            'training_access',
            'training_create',
            'training_edit',
            'training_delete',
            'trainee_edit',
            'trainee_access',
            'technicalTrainee_edit',
            'technicalTrainee_access',
        ];

        $this->storePermission($permissions);
    }
}

<?php

namespace Modules\DigitalBoard\Database\Seeders;

use App\Traits\StorePermissionTrait;
use Illuminate\Database\Seeder;

class DigitalBoardPermissionTableSeeder extends Seeder
{
    use StorePermissionTrait;

    public function run()
    {
        $permissions = [
            'digitalBoardDashboard_access',
            'digitalBoardVideo_access',
            'digitalBoardVideo_create',
            'digitalBoardVideo_edit',
            'digitalBoardVideo_delete',
            'digitalBoardNotice_access',
            'digitalBoardNotice_create',
            'digitalBoardNotice_edit',
            'digitalBoardNotice_delete',
            'digitalBoardNews_access',
            'digitalBoardNews_create',
            'digitalBoardNews_edit',
            'digitalBoardNews_delete',
        ];

        $this->storePermission($permissions);
    }
}

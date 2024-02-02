<?php

namespace Modules\ExecutiveMeeting\Database\Seeders;

use App\Traits\StorePermissionTrait;
use Illuminate\Database\Seeder;

class ExecutiveMeetingPermissionTableSeeder extends Seeder
{
    use StorePermissionTrait;

    public function run()
    {
        $permissions = [
            'executiveMeetingDashboard_access',
            'committeeType_access',
            'committeeType_create',
            'committeeType_edit',
            'committeeType_delete',
            'committee_access',
            'committee_create',
            'committee_edit',
            'committee_delete',
            'committeeMember_access',
            'committeeMember_create',
            'committeeMember_edit',
            'committeeMember_delete',
            'meeting_access',
            'meeting_create',
            'meeting_edit',
            'meeting_delete',
            'meetingAgenda_access',
            'meetingAgenda_create',
            'meetingAgenda_edit',
            'meetingAgenda_delete',
            'meetingDecision_access',
            'meetingDecision_create',
            'meetingDecision_edit',
            'meetingDecision_delete',
        ];

        $this->storePermission($permissions);
    }
}

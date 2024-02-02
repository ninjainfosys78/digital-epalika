<?php

namespace Modules\JudicialCommittee\Database\Seeders;

use App\Traits\StorePermissionTrait;
use Illuminate\Database\Seeder;

class JudicialPermissionTableSeeder extends Seeder
{
    use StorePermissionTrait;

    public function run()
    {
        $permissions = [
            'judicialCommitteeDashboard_access',
            'lawsuitNature_access',
            'lawsuitNature_create',
            'lawsuitNature_edit',
            'lawsuitNature_delete',
            'complaintSubject_access',
            'complaintSubject_create',
            'complaintSubject_edit',
            'complaintSubject_delete',
            'judicialMember_access',
            'judicialMember_create',
            'judicialMember_edit',
            'judicialMember_delete',
            'judicialCommitteeTemplate_access',
            'judicialCommitteeTemplate_create',
            'judicialCommitteeTemplate_edit',
            'judicialCommitteeTemplate_delete',
            'complaintApplication_access',
            'complaintApplication_create',
            'complaintApplication_edit',
            'complaintApplication_delete',
            'judicialReceiptBill_access',
            'judicialReceiptBill_create',
            'judicialReceiptBill_edit',
            'judicialReceiptBill_delete',
            'dateSheet_access',
            'dateSheet_create',
            'dateSheet_edit',
            'dateSheet_delete',
            'defendantIssuedDeadline_access',
            'defendantIssuedDeadline_create',
            'defendantIssuedDeadline_edit',
            'defendantIssuedDeadline_delete',
            'dateCompensation_access',
            'dateCompensation_create',
            'dateCompensation_edit',
            'dateCompensation_delete',
            'writtenAnswer_access',
            'writtenAnswer_create',
            'writtenAnswer_edit',
            'writtenAnswer_delete',
            'complaintDecision_access',
            'complaintDecision_create',
            'complaintDecision_edit',
            'complaintDecision_delete',
            'conciliationApplication_access',
            'conciliationApplication_create',
            'conciliationApplication_edit',
            'conciliationApplication_delete',
            'conciliationVerification_access',
            'conciliationVerification_create',
            'conciliationVerification_edit',
            'conciliationVerification_delete',
            'conciliation_access',
            'conciliation_create',
            'conciliation_edit',
            'conciliation_delete',
        ];

        $this->storePermission($permissions);
    }
}

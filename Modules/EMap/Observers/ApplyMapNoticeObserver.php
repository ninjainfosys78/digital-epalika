<?php

namespace Modules\EMap\Observers;

use Modules\EMap\Entities\ApplyMapNotice;

class ApplyMapNoticeObserver
{
    public function creating(ApplyMapNotice $applyMapNotice): void
    {
        $appliedApplications = ApplyMapNotice::whereNull('rejected_at')
            ->where('map_apply_id', $applyMapNotice->map_apply_id)
            ->where('file_type', $applyMapNotice->file_type->value)
            ->get();


        foreach ($appliedApplications as $appliedApplication) {
            $appliedApplication->rejected_at = now();
            $appliedApplication->remarks = 'rejected because of more file upload :system generated';
            $appliedApplication->saveQuietly();
        }
    }

    public function updating(ApplyMapNotice $applyMapNotice): void
    {
        $appliedApplications = ApplyMapNotice::whereNull('rejected_at')
            ->where('id', '!=', $applyMapNotice->id)
            ->where('map_apply_id', $applyMapNotice->map_apply_id)
            ->where('file_type', $applyMapNotice->file_type->value)
            ->get();

        foreach ($appliedApplications as $appliedApplication) {
            $appliedApplication->rejected_at = now();
            $appliedApplication->remarks = 'rejected because of more file upload :system generated';
            $appliedApplication->saveQuietly();
        }
    }
}

<?php

namespace App\Console\Commands;

use App\Mail\GrievanceHandling\GrievanceAssignmentFromUserMail;
use App\Mail\GrievanceHandling\GrievanceAssignmentToGrievanceUserMail;
use App\Mail\GrievanceHandling\GrievanceAssignmentToUserMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Modules\GrievanceHandling\Entities\GrievanceDetail;
use Modules\GrievanceHandling\Entities\GrievanceSetting;
use Modules\GrievanceHandling\Enums\GrievanceStatus;

class GrievanceEscalationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'grievance:escalate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grievance Escalation';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $grievanceSetting = GrievanceSetting::first();
        $grievanceDetails = GrievanceDetail::with('assignedUser')
            ->whereHas('assignedUser', function ($query) {
                $query->whereNotNull('user_id');
            })
            ->where('status', GrievanceStatus::UNSEEN)
            ->whereNull('grievance_detail_id')
            ->whereRaw("DATE(assigned_at) = CURDATE() - INTERVAL $grievanceSetting->escalation_days DAY")
            ->get();

        foreach ($grievanceDetails as $grievanceDetail) {
            $grievanceAssign = $grievanceDetail->grievanceAssignHistories()->create([
                'from_user_id' => $grievanceDetail->assigned_user_id,
                'user_id' => $grievanceDetail->assignedUser->user_id
            ]);

            $grievanceDetail->update([
                'assigned_user_id' => $grievanceDetail->assignedUser->user_id,
                'assigned_at' => now()
            ]);
            //mail to assigned user
            Mail::to($grievanceAssign->user->email)->send(new GrievanceAssignmentToUserMail($grievanceDetail, $grievanceAssign));

            //mail to (from assigned user)
            Mail::to($grievanceAssign->fromUser->email)->send(new GrievanceAssignmentFromUserMail($grievanceDetail, $grievanceAssign));

            //mail to grievance user
            if ($grievanceDetail->grievanceUser->email) {
                Mail::to($grievanceDetail->grievanceUser->email)->send(new GrievanceAssignmentToGrievanceUserMail($grievanceDetail, $grievanceAssign));
            }
        }

        $this->info('Grievance Escalation');

        return 0;
    }
}

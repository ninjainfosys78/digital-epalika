<?php

namespace App\Console\Commands;

use App\Channel\Message\AakashSmsMessage;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Modules\ExecutiveMeeting\Entities\Meeting;

class SendExecutiveCommitteeMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'executiveCommitteeMessage:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws Exception
     */
    public function handle(): int
    {
        $meetings = Meeting::with('committee.committeeMembers')
            ->where('recurrence', '!=', 'emergency')
            ->whereDate('en_start_date', Carbon::tomorrow()->toDateString())
            ->get();

        foreach ($meetings as $meeting) {
            $phoneNumbers = implode(',', $meeting->committee->committeeMembers->pluck('phone')->toArray());

            (new AakashSmsMessage())
                ->receiver($phoneNumbers)
                ->message($meeting->description)
                ->send();
        }

        return 0;
    }
}

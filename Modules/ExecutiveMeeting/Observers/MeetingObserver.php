<?php

namespace Modules\ExecutiveMeeting\Observers;

use App\Channel\Message\AakashSmsMessage;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Support\Carbon;
use Modules\ExecutiveMeeting\Entities\Meeting;

class MeetingObserver
{
    /**
     * @throws Exception
     */
    public function created(Meeting $meeting): void
    {
        if ($meeting->recurrence->value == 'emergency') {
            $meeting->load('committee.committeeMembers');
            $phoneNumbers = implode(',', $meeting->committee->committeeMembers->pluck('phone')->toArray());
            (new AakashSmsMessage())->receiver($phoneNumbers ?? '')
                ->message($meeting->description ?? '')
                ->send();
            return;
        }

        if ($meeting->recurrence->value === 'no_recurrence') {
            return;
        }

        if (!$meeting->meeting()->exists()) {
            $recurrences = [
                'daily' => [
                    'type' => 'day',
                    'function' => 'addDay',
                ],
                'weekly' => [
                    'type' => 'week',
                    'function' => 'addWeek',
                ],
                'monthly' => [
                    'type' => 'month',
                    'function' => 'addMonth',
                ],
                'yearly' => [
                    'type' => 'year',
                    'function' => 'addYear',
                ],
            ];
            $start_date = Carbon::parse($meeting->start_date);
            $en_start_date = Carbon::parse($meeting->en_start_date);
            $end_date = Carbon::parse($meeting->end_date);
            $en_end_date = Carbon::parse($meeting->en_end_date);
            $recurrence = $recurrences[$meeting->recurrence->value];

            if ($recurrence) {
                $recurrenceDates = CarbonPeriod::create($en_start_date, '1 ' . $recurrence['type'], $meeting->en_recurrence_end_date);
                $iMax = count($recurrenceDates);

                for ($i = 0; $i < $iMax; $i++) {
                    $start_date->{$recurrence['function']}();
                    $en_start_date->{$recurrence['function']}();
                    $end_date->{$recurrence['function']}();
                    $en_end_date->{$recurrence['function']}();
                    $meeting->meetings()->create([
                        'committee_id' => $meeting->committee_id,
                        'fiscal_year_id' => $meeting->fiscal_year_id,
                        'meeting_name' => $meeting->meeting_name,
                        'recurrence' => $meeting->recurrence,
                        'start_date' => $start_date->toDateString(),
                        'en_start_date' => $en_start_date->toDateString(),
                        'end_date' => $end_date->toDateString(),
                        'en_end_date' => $en_end_date->toDateString(),
                        'recurrence_end_date' => $meeting->recurrence_end_date,
                        'en_recurrence_end_date' => $meeting->en_recurrence_end_date,
                        'description' => $meeting->description,
                        'user_id' => auth()->id()
                    ]);
                }
            }
        }
    }

    public function updated(Meeting $meeting): void
    {
        if ($meeting->meeting || $meeting->meetings()->exists()) {
            $start_date = Carbon::parse($meeting->getOriginal('start_date'));
            $en_start_date = Carbon::parse($meeting->en_start_date);
            $end_date = Carbon::parse($meeting->end_date);
            $en_end_date = Carbon::parse($meeting->en_end_date);

            //$startTime = Carbon::parse($meeting->getOriginal('start_time'))->diffInSeconds($meeting->start_time, false);
            //$endTime = Carbon::parse($meeting->getOriginal('end_time'))->diffInSeconds($meeting->end_time, false);
            if ($meeting->meeting) {
                $childEvents = $meeting->meeting->meetings()->whereDate('en_start_date', '>', $meeting->getOriginal('en_start_date'))->get();
            } else {
                $childEvents = $meeting->meetings;
            }

            foreach ($childEvents as $childEvent) {
                if ($en_start_date) { //$childEvent->en_start_date = Carbon::parse($childEvent->en_start_date)->addSeconds($en_start_date);
                    $childEvent->en_start_date = Carbon::parse($childEvent->en_start_date);
                }
                if ($en_end_date) { //$childEvent->end_time = Carbon::parse($childEvent->end_time)->addSeconds($endTime);
                    $childEvent->en_end_date = Carbon::parse($childEvent->en_end_date);
                }
                if ($meeting->isDirty('meeting_name') && $childEvent->meeting_name === $meeting->getOriginal('meeting_name')) {
                    $childEvent->meeting_name = $meeting->meeting_name;
                }
                if ($meeting->isDirty('description') && $childEvent->description === $meeting->getOriginal('description')) {
                    $childEvent->description = $meeting->description;
                }
                $childEvent->saveQuietly();
            }
        }

        //        if($meeting->isDirty('recurrence') && $meeting->recurrence != 'none')
        //            self::created($meeting);
    }

    public function deleted(Meeting $meeting): void
    {
        if ($meeting->meetings()->exists()) {
            $meetings = $meeting->meetings()->pluck('id');
        } elseif ($meeting->meeting) {
            $meetings = $meeting->meeting->meetings()->whereDate('en_start_date', '>', $meeting->en_start_date)->pluck('id');
        } else {
            $meetings = [];
        }

        Meeting::whereIn('id', $meetings)->delete();
    }
}

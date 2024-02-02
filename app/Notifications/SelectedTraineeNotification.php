<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\Roaster\Entities\Trainee;
use Modules\Roaster\Entities\TraineeUser;

class SelectedTraineeNotification extends Notification
{
    use Queueable;

    public function __construct(public Trainee $trainee, public TraineeUser $traineeUser)
    {
        //
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'संस्था' => $this->traineeUser->name,
            'तालिमको नाम' => $this->trainee->trainingTrainee?->training?->name ?? '',
            'नाम' => $this->trainee->full_name ?? ''
        ];
    }
}

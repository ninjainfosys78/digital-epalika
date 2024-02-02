<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\Circular\Entities\Registration;

class RegistrationNotification extends Notification
{
    use Queueable;


    public function __construct(public  Registration $registration)
    {
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
            'दर्ता न.' => $this->registration->registration_no ?? '',
            'दर्ता मिति' => $this->registration->registration_date ?? '',
            'पत्र संख्या' => $this->registration->letter_number ?? '',
        ];
    }
}

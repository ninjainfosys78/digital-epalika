<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\EMap\Entities\MapApply;

class MapApplyNotification extends Notification
{
    use Queueable;


    public function __construct(public MapApply $mapApply)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'निर्माण कार्यको किसिम' => $this->mapApply->construction_type?->label() ?? '',
            'भवन वर्गीकरण' => $this->mapApply->building_category ?? '',
            'स्ट्रकचर टाईप' => $this->mapApply->structureType?->title ?? '',
//            'घर धनीको नाम' => $this->mapApply->houseOwner->name ?? '',
            'application_type' => $this->mapApply->application_type->label() ?? '',
            'सन्देश' => $this->mapApply->sent_to_organization == 'Reject' || $this->mapApply->sent_to_organization == 'Unseen' ? 'तपाईको फारम पालिकाले अस्वीकार गरेको छ' : 'तपाईको फारम पालिकाले स्वीकार गरेको छ'
        ];
    }
}

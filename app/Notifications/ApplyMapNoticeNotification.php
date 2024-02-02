<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\EMap\Entities\ApplyMapNotice;
use Modules\EMap\Entities\MapApply;

class ApplyMapNoticeNotification extends Notification
{
    use Queueable;

    public function __construct(public MapApply $mapApply, public ApplyMapNotice $applyMapNotice)
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
            'सब्मिसन आइडी' => $this->mapApply->unique_id,
            'घर धनीको नाम' => $this->mapApply->houseOwner?->name ?? '',
            'निर्माण कार्यको किसिम' => $this->mapApply->construction_type?->label() ?? '',
            'निबेदन/प्रतिबेदन' => $this->applyMapNotice->file_type->label() ?? '',
            'परामर्शदाताको नाम' => $this->mapApply->organization->name ?? '',
        ];
    }
}

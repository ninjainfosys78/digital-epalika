<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\EMap\Entities\AppliedDocument;
use Modules\EMap\Entities\Form;
use Modules\EMap\Entities\FormDataType;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Enums\FormTypeEnum;

class StepNotification extends Notification
{
    use Queueable;


    public function __construct(public MapApply $mapApply, public Form $form, public FormDataType $formDataType, public AppliedDocument $appliedDocument)
    {
        $this->appliedDocument = $appliedDocument->load('appliedDocumentStatuses');
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
            "शिर्षक" => $this->form->title,
            "स्थिति" => $this->appliedDocument->status->label() ?? '',
            "मिति" => $this->appliedDocument->created_at->toDateString(),
            'प्रकार' => FormTypeEnum::FILE->value,
            'टिप्पणी' => $this->appliedDocument->appliedDocumentStatuses()->latest()->first()->comment ?? ''
        ];
    }
}

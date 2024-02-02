<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\EMap\Entities\Form;
use Modules\EMap\Entities\FormDataType;
use Modules\EMap\Entities\FormStore;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Enums\FormTypeEnum;

class FormStoreNotification extends Notification
{
    use Queueable;


    public function __construct(public MapApply $mapApply, public Form $form, public FormDataType $formDataType, public FormStore $formStore)
    {
        $this->formStore = $formStore->load('formStoreStatuses');
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
            "स्थिति" => $this->formStore->status->label() ?? '',
            "मिति" => $this->formStore->created_at->toDateString(),
            'प्रकार' => FormTypeEnum::FORM->value,
            'टिप्पणी' => $this->formStore->formStoreStatuses()->latest()->first()->comment ?? ''

        ];
    }
}

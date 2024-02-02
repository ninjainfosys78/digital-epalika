<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\EMap\Entities\Form;
use Modules\EMap\Entities\FormDataType;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Entities\PaymentStore;
use Modules\EMap\Enums\FormTypeEnum;

class PaymentStoreNotification extends Notification
{
    use Queueable;


    public function __construct(public MapApply $mapApply, public Form $form, public FormDataType $formDataType, public PaymentStore $paymentStore)
    {
        $this->paymentStore = $paymentStore->load('paymentStoreStatuses');
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
            "स्थिति" => $this->paymentStore->status->label() ?? '',
            "मिति" => $this->paymentStore->created_at->toDateString(),
            'प्रकार' => FormTypeEnum::PAYMENT->value,
            'टिप्पणी' => $this->paymentStore->paymentStoreStatuses()->latest()->first()->comment ?? ''
        ];
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Modules\Circular\Entities\Registration;

class RegistrationMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public Registration $registration)
    {
        //
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.circular.registration',
        );
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GrievanceDetailMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public $message)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'गुनासो दर्ता',
        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.grievanceHandling.grievanceDetail', [
            'message' => $this->message
        ]);
    }
}

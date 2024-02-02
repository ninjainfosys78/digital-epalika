<?php

namespace App\Mail\GrievanceHandling;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Modules\GrievanceHandling\Entities\GrievanceDetail;

class GrievanceAssignmentToGrievanceUserMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public GrievanceDetail $grievanceDetail, public $grievanceAssign)
    {
        $this->grievanceDetail->load('grievanceUser');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            subject: 'Grievance Transfer',
        );
    }

    public function build()
    {
        return $this->markdown('emails.grievanceHandling.grievanceAssignmentToGrievanceUserMail')->with([
            'grievanceDetail' => $this->grievanceDetail,
            'grievanceAssign' => $this->grievanceAssign
        ]);
    }
}

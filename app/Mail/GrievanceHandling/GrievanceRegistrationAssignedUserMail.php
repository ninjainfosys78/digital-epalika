<?php

namespace App\Mail\GrievanceHandling;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Modules\GrievanceHandling\Entities\GrievanceDetail;

class GrievanceRegistrationAssignedUserMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public GrievanceDetail $grievanceDetail)
    {
        $this->grievanceDetail->load('files', 'grievanceUser');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            subject: 'गुनासो दर्ता',
        );
    }

    public function build()
    {
        return $this->markdown('emails.grievanceHandling.grievanceRegistrationAssignedUserMail')->with([
            'grievanceDetail' => $this->grievanceDetail
        ]);
    }

    public function attachments(): array
    {
        $attachments = [];
        foreach ($this->grievanceDetail->files as $file) {
            if (Storage::disk('public')->exists($file->file)) {
                $mimeType = Storage::disk('public')->mimeType($file->file);
                $attachments[] = Attachment::fromStorageDisk('public', $file->file)
                    ->as($file->file_name)
                    ->withMime($mimeType);
            }
        }
        return $attachments;
    }
}

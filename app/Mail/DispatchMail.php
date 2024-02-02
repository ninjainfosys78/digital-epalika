<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Modules\Circular\Entities\DispatchDetail;

class DispatchMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public DispatchDetail $dispatchDetail)
    {
        $this->dispatchDetail->load('files', 'dispatch');
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            subject: 'Dispatch',
        );
    }



    public function build()
    {
        return $this->markdown('emails.circular.dispatch')
            ->with('dispatchDetail', $this->dispatchDetail);
    }


    public function attachments(): array
    {
        $attachments = [];
        foreach ($this->dispatchDetail->files as $file) {
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

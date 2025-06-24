<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\EssaiMessure;

class EssaiMessureReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $essaiMessure;

    public function __construct(EssaiMessure $essaiMessure)
    {
        $this->essaiMessure = $essaiMessure;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Reminder: {$this->essaiMessure->name} (Essai/Messure) starts in one month",
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.essai-messure-reminder',
            with: [
                'essaiMessure' => $this->essaiMessure,
                'daysLeft' => now()->diffInDays($this->essaiMessure->start_date)
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProjectReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $project;

    public function __construct($project)
    {
        $this->project = $project;
    }

    public function envelope(): Envelope
{
    return new Envelope(
        subject: "Reminder: {$this->project->name} starts in one month",
    );
}

public function content(): Content
{
    return new Content(
        markdown: 'emails.project-reminder',
        with: [
            'project' => $this->project,
            'daysLeft' => now()->diffInDays($this->project->start_date)
        ]
    );
}

    public function attachments(): array
    {
        return [];
    }
}

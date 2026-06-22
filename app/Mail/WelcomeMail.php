<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $messageBody;
    public $subject;

    public function __construct(
        $user,
        $messageBody,
        $subject
    ) {
        $this->user = $user;
        $this->messageBody = $messageBody;
        $this->subject = $subject;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject
        );
    }

    public function content(): Content
    {
        return new Content(
        view: 'emails.welcome',
        with: [
            'user' => $this->user,
            'messageBody' => $this->messageBody,
            'subject' => $this->subject,
        ]
    );
    }
}
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $content;
    public array $options;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct(string $subject, string $content, array $options = [])
    {
        $this->subject = $subject; // This is allowed in constructor
        $this->content = $content;
        $this->options = $options;
        $this->user = $options['user'] ?? null;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.custom',
            with: [
                'content' => $this->content,
                'user' => $this->user,
                'options' => $this->options,
                'subject' => $this->subject,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
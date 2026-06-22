<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $propertytitle;
    public $messageBody;
    public $subject;
    public $bookings;

    /**
     * Create a new message instance.
     */
    public function __construct( $user,
     $messageBody,
    $subject,   
    $propertytitle,
       $bookings)
    {
        //
        $this->user = $user;
        $this->messageBody = $messageBody;
        $this->subject = $subject;
        $this->propertytitle = $propertytitle;
        
        $this->bookings = $bookings;
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
            view: 'emails.booking-confirmation',

             with: [
            'user' => $this->user,
            'messageBody' => $this->messageBody,
            'subject' => $this->subject,
            'propertytitle' => $this->propertytitle,
            
            'booking' => $this->bookings,
        ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

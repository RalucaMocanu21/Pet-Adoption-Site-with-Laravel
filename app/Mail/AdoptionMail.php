<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdoptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $requestDetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($requestDetails)
    {
        $this->requestDetails = $requestDetails;
    }

    public function build()
    {
        return $this->view('email.adoption_request')
                    ->subject('O nouă cerere de adopție a fost trimisă')
                    ->with([
                        'requestDetails' => $this->requestDetails,
                    ]);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'O nouă cerere de adopție a fost trimisă',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.adoption_request',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}

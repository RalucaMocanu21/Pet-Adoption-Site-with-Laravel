<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewAnimalPostedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $animal;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($animal)
    {
        $this->animal = $animal;
    }

    public function build()
    {
        return $this->view('email.new_animal_posted')
                    ->subject('Un nou animal a fost postat')
                    ->with([
                        'animal' => $this->animal,
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
            subject: 'Un nou animal a fost postat',
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
            view: 'email.new_animal_posted',
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

<?php

namespace App\Mail;

use App\Models\PasswordReset;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $user_password;
    public $user_email;
    public $token;

    public function __construct($UID)
    {
        //extracting all the data
        $user_info = User::all()->where('id', '=', $UID)->first();
        $tokenContent = PasswordReset::all()->where('user_id', '=', $user_info->id)->first();

        $this->user = $user_info->username;
        $this->user_email = $user_info->email;
        $this->user_password = $user_info->username.'_smart_farmer_user';
        $this->token = $tokenContent->token;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Registration Mail',
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
            markdown: 'emails.registration',
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

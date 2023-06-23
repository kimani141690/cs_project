<?php

namespace App\Mail;

use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class verifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $user_password;
    public $user_email;
    public $user_id;

    public $token;
    public $tokenID;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $userInfo = User::all()->where('id', '=', $data)->first();
        $this->user_id =$userInfo->id;
        $tokenContent = VerifyUser::all()->where('user_id', '=', $userInfo->id)->first();
        $password=$userInfo->name.'_smart_farmer_user';
        $this->user = $userInfo->name;
        $this->user_email = $userInfo->email;
        $this->user_password = $password;
        $this->tokenID = $tokenContent->id;
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
            subject: 'Verify Email',
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
            markdown: 'auth.verify_email',
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

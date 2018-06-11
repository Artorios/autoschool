<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class PasswordChanged extends Mailable
{
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.password_changed');
    }
}

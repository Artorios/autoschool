<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ConfirmPasswordChange extends Mailable
{
    private $url;

    /**
     * Create a new message instance.
     *
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirm_password_email', [
            'url' => $this->url
        ]);
    }
}

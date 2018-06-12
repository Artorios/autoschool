<?php

namespace App\Listeners;

use App\{
    Events\UserPasswordChangedEvent,
    Mail\PasswordChanged
};
use Illuminate\Support\Facades\Mail;

class UserEmailChangedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserPasswordChangedEvent $event
     * @return void
     */
    public function handle(UserPasswordChangedEvent $event)
    {
        Mail::to($event->user->email)->send(new PasswordChanged());
    }
}

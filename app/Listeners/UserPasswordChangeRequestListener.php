<?php

namespace App\Listeners;

use App\{
    Events\UserPasswordChangeRequestEvent,
    Mail\ConfirmPasswordChange
};
use Illuminate\Support\Facades\Mail;

class UserPasswordChangeRequestListener
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
     * @param  UserPasswordChangeRequestEvent  $event
     * @return void
     */
    public function handle(UserPasswordChangeRequestEvent $event)
    {
        Mail::to($event->email)->send(new ConfirmPasswordChange($event->url));
    }
}

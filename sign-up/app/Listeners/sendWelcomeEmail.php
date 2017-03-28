<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Mailer\UserMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendWelcomeEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public  $email;
    public function __construct(UserMailer $mailer)
    {
        $this->email=$mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
       $this->email->welcome($event->user);
    }
}

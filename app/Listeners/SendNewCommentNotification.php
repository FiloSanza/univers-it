<?php

namespace App\Listeners;

use App\Events\NewCommentEvent;
use App\Notifications\NewCommentNotification;

class SendNewCommentNotification
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
     * @param  \App\Events\NewCommentEvent  $event
     * @return void
     */
    public function handle(NewCommentEvent $event)
    {
        $user = $event->comment->post()->first()->user()->first();
        $user->notify(new NewCommentNotification($user, $event->comment));
    }
}

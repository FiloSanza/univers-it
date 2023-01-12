<?php

namespace App\Listeners;

use App\Events\NewPostEvent;
use App\Notifications\NewPostNotification;

class SendNewPostNotification
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
     * @param  \App\Events\NewPostEvent  $event
     * @return void
     */
    public function handle(NewPostEvent $event)
    {
        $followers = $event->post->user()->first()->followers()->get();
        foreach($followers as $user) {
            $user->notify(new NewPostNotification($user, $event->post));
        }
    }
}

<?php

namespace App\Listeners;

use App\Events\NewFollowerEvent;
use App\Notifications\NewFollowerNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNewFollowerNotification
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
     * @param  \App\Events\NewFollowerEvent  $event
     * @return void
     */
    public function handle(NewFollowerEvent $event)
    {
        $user = $event->edge->followed()->first();
        $follower = $event->edge->follower()->first();
        $user->notify(new NewFollowerNotification($user, $follower));
    }
}

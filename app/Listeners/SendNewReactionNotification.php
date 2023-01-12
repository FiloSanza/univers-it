<?php

namespace App\Listeners;

use App\Events\NewReactionEvent;
use App\Models\Post;
use App\Models\User;
use App\Notifications\NewReactionNotification;

class SendNewReactionNotification
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
     * @param  \App\Events\NewReactionEvent  $event
     * @return void
     */
    public function handle(NewReactionEvent $event)
    {
        $post = Post::where(['id' => $event->reaction->post_id])->first();
        $reaction_user = User::where(['id' => $event->reaction->user_id])->first();
        $notified_user = $post->user()->first();

        $notified_user->notify(new NewReactionNotification($reaction_user, $post));
    }
}

<?php

namespace App\Events;

use App\Models\PostReaction;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewReactionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The newly created Reaction.
     * 
     * @var \App\Models\PostReaction
     */
    public $reaction;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PostReaction $reaction)
    {
        $this->reaction = $reaction;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

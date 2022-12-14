<?php

namespace App\Events;

use App\Models\FollowEdge;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewFollowerEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The newly created follow edge.
     * 
     * @var \App\Models\FollowEdge
     */
    public $edge;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(FollowEdge $follow_edge)
    {
        $this->edge = $follow_edge;
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

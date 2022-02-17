<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SentName implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name;
    public $user_id;
    public $bingo_id;

    public function __construct($name, $user_id, $bingo_id)
    {
        $this->name = $name;
        $this->user_id = $user_id;
        $this->bingo_id = $bingo_id;
    }

    public function broadcastOn()
    {
        return 'name-channel';
    }

    public function broadcastAs()
    {
        return 'name-event';
    }
}

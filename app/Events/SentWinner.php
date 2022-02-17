<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SentWinner implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ganador_final_nombre;
    public $winner_id;

    public function __construct($ganador_final_nombre, $winner_id)
    {
        $this->ganador_final_nombre = $ganador_final_nombre;
        $this->winner_id = $winner_id;
    }

    public function broadcastOn()
    {
        return 'winner-channel';
    }

    public function broadcastAs()
    {
        return 'winner-event';
    }
}

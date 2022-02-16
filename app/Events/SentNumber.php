<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SentNumber implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $numero;
    //public $bingo_id;

    public function __construct($numero)
    {
        $this->numero = $numero;
        //$this->bingo_id = $bingo_id;
    }

    public function broadcastOn()
    {
        return 'bingo-channel';
    }

    public function broadcastAs()
    {
        return 'bingo-event';
    }
}

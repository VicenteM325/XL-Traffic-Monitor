<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\monitor\Semaforo;

class SemaforoActualizado implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $semaforo;

    public function __construct(Semaforo $semaforo)
    {
        $this->semaforo = $semaforo;
    }

    public function broadcastOn()
    {
        return new Channel('semaforos');
    }
}

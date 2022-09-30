<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Absence;

class AbsenceAction
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $absence;
    private $action;


    public function getAbsence()
    {
        return $this->absence;
    }
    public function getAction()
    {
        return $this->action;
    }
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Absence $absence, $action)
    {
        $this->absence = $absence;
        $this->action = $action;
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

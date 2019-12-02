<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * Class SendLoginMessage
 * @package App\Events
 */
class SendLoginMessage
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ip;
    public $account;
    public $email;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ip,$account,$email) {
        $this->ip = $ip;
        $this->account = $account;
        $this->email = $email;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn() {
        return new PrivateChannel('channel-name');
    }
}

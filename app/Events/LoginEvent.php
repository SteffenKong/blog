<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LoginEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $adminData;
    public $lastLoginTime;
    public $lastLoginIp;
    public $email;
    public $phone;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($adminData,$lastLoginTime,$lastLoginIp,$email,$phone) {
        $this->adminData = $adminData;
        $this->lastLoginTime = $lastLoginTime;
        $this->lastLoginIp = $lastLoginIp;
        $this->email = $email;
        $this->phone = $phone;
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

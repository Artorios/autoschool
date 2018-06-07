<?php

namespace App\Events;

use Illuminate\{
    Queue\SerializesModels,
    Broadcasting\PrivateChannel,
    Foundation\Events\Dispatchable
};

class UserPasswordChangeRequestEvent
{
    use Dispatchable, SerializesModels;

    public $url;
    public $email;

    /**
     * Create a new event instance.
     *
     * @param string $url
     */
    public function __construct(string $url, string $email)
    {
        $this->url = $url;
        $this->email = $email;
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

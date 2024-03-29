<?php

namespace App\Events;

use App\Models\User\User;
use Illuminate\{
    Queue\SerializesModels,
    Broadcasting\PrivateChannel,
    Foundation\Events\Dispatchable
};

class UserPasswordChangedEvent
{
    use Dispatchable, SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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

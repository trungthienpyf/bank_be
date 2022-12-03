<?php

namespace App\Events;


use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessagePosted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public  $comment;
    public  $user;
    public  $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($comment,$user,$message)
    {
        $this->comment=$comment;
        $this->user=$user;
        $this->message=$message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {

        return new Channel('post.'.$this->comment);
    }
    public function broadcastWith()
    {
        return [

            'user' => $this->user,
            'message' => $this->message,
            'post_id' => $this->comment,

        ];
    }
}

<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $message;
    public $conversationId;

    public function __construct(Message $message)
    {
        $this->message = $message->load('user');
        $this->conversationId = $this->message->conversation_id;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('conversation.' . $this->conversationId);
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->message->id,
            'message' => $this->message->message,
            'conversation_id' => $this->conversationId,
            'user' => [
                'id' => $this->message->user->id,
                'name' => $this->message->user->name,
            ],
            'created_at' => $this->message->created_at->toDateTimeString(),
        ];
    }
}

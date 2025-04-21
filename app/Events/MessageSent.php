<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    /**
     * Create a new event instance.
     */
    public function __construct($message)
    {
        //
        $this->message = $message;
        \Log::info('Broadcasting message to room: ' . $message->room_id);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    // Canal sur lequel l'événement sera diffusé
    public function broadcastOn(): array
    {
        return [new Channel('room-' . $this->message->room_id)];
    }

    // Nom de l'événement frontend
    public function broadcastAs(): string
    {
        return 'message-sent';
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message->content,
            'sender_name' => $this->message->sender->name,
            'room_id' => $this->message->room_id,
            'sent_at' => $this->message->created_at,
        ];
    }
}

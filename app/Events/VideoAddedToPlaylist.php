<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VideoAddedToPlaylist
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $roomId;
    public $video;
    /**
     * Create a new event instance.
     */
    public function __construct($roomId, $video)
    {
        //
        $this->roomId = $roomId;
        $this->video = $video;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {

        return [new Channel('room-'.$this->roomId)];
    }

    public function broadcastAs(): string
    {
        return 'video-add-playlist';
    }


    public function broadcastWith()
    {
        return [
            'room_id' => $this->roomId,
            'video' => $this->video,
        ];
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\VideoRoom;
use Illuminate\Http\Request;

class VideoController extends BaseController
{
    //

    use App\Http\Resources\RoomResource;
    use App\Models\VideoRoom;

    public function index(Request $request)
    {
        $roomId = $request->query('id');

        $videos = VideoRoom::join('rooms', 'rooms.id', '=', 'room_video.room_id')
            ->join('video', 'video.id', '=', 'room_video.video_id')
            ->select(
                'room_video.*',
                'rooms.name as room_name',
                'rooms.thumbnail as room_thumbnail',
                'rooms.url as room_url',
                'video.title as video_title',
                'video.url as video_url'
            )
            ->where('room_video.room_id', $roomId)
            ->get();

        $room = Room::with(['host', 'users', 'playlist', 'videos', 'chat'])
            ->findOrFail($roomId);

        // Retourner la réponse transformée avec RoomResource
        return new RoomResource($room);
    }


}

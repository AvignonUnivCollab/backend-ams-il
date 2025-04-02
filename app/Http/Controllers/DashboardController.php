<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Playlist;
use App\Models\Room;
use App\Models\Video;
use App\Models\VideoRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function statsAndCurrentUser() {
        $videosCount = Video::count();
        $playlistCount = Playlist::count();
        $messageCount = Message::count();
        $salonCount = Room::count();

        $user = Auth::user();

        $messages = Message::join('users', 'users.id', '=', 'messages.sender_id')
            ->join('rooms', 'rooms.id', '=', 'messages.room_id')
            ->select(
                'messages.content',
                'users.name as name',
                'users.username as username',
                'rooms.name',
                'messages.created_at',
            )
            ->orderBy('messages.created_at', 'desc')
            ->get();


        $videos = VideoRoom::join('rooms', 'rooms.id', '=', 'room_video.room_id')
            ->join('videos', 'videos.id', '=', 'room_video.video_id')
            ->join('users', 'users.id', '=', 'rooms.host_id')
            ->join('categories', 'categories.id', '=', 'videos.category_id')
            ->select(
                'videos.thumbnail',
                'videos.title as video_name',
                'videos.description as description',
                'rooms.name as room_name',
                'categories.name as category_name',
                'users.name as username',
            )
            ->get();

        $data = [
            'videoCount' => $videosCount,
            'playlistCount' => $playlistCount,
            'messageCount' => $messageCount,
            'salonCount' => $salonCount,
            'user' => $user,
            'messages' => $messages,
            'videos' => $videos,
        ];

        return view('dashboard', compact('data'));
    }

}

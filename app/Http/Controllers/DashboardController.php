<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Playlist;
use App\Models\Room;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function statsAndCurrentUser() {
        $videos = Video::count();
        $playlistCount = Playlist::count();
        $messageCount = Message::count();
        $salonCount = Room::count();

        $user = Auth::user();

        $data = [
            'videoCount' => $videos,
            'playlistCount' => $playlistCount,
            'messageCount' => $messageCount,
            'salonCount' => $salonCount,
            'user' => $user,
        ];

        return view('dashboard', compact('data'));
    }


}

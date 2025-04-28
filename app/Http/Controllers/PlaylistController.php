<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    //

    public function index(Request $request) 
    {
        $rooms = Room::with('playlist.videos')
                    ->join('rooms', 'rooms.id', '=', 'playlists.room_id')
                    ->select(
                        'rooms.id',
                        'rooms.name',
                        ''
                    )
                    ->get();
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\PlaylistVideo;
use App\Models\Video;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class PlaylistController extends BaseController
{
    //

    public function index(Request $request)
    {
        $user = $this->authenticate($request);

        if(!$user) {
            return $this->sendError('Unauthorised', 401);
        }

        $playlist = Playlist::with(['videos'])->get();

        return $this->sendResponse($playlist, 'Playlists retrived succesfully');

    }


    public function getPlaylistByRoom(Request $request, $roomId)
    {
        $user = $this->authenticate($request);

        if(!$user) {
            return $this->sendError('Unauthorised', 401);
        }

        $playlist = Playlist::with(['videos'])->where('room_id', $roomId)->first();

        if(!$playlist) {
            return $this->sendError('Playlist not found', 404);
        }

        return $this->sendResponse($playlist, 'Playlists retrived succesfully'); 
    }

   
    public function addVideoToPlaylist(Request $request, $roomId) 
    {
        $user = $this->authenticate($request);

        if(!$user) {
            return $this->sendError('Unauthorised', 401);
        }

        $video = Video::where('id', $request->video_id)->get();

        if(!$video) {
            return $this->sendError('Video not found', 404);
        }

        $request->validate([
            'video_id' => 'required|exists:videos,id'
        ]);

        $playlist = Playlist::firstOrCreate(['room_id' => $roomId]);
        $maxOrder = PlaylistVideo::where('playlist_id', $playlist->id)->max('order');
        $playlistVideo = PlaylistVideo::create([
            'playlist_id' => $playlist->id,
            'video_id' => $request->video_id,
            'order' => $maxOrder !== null ? $maxOrder + 1 : 0
        ]);

        return $this->sendResponse($playlistVideo, 'Video added to playlist succesfully'); 
    }


    public function removeVideoFromPlaylist(Request $request, $playlistVideoId)
    {
        $user = $this->authenticate($request);
        if(!$user) {
            return $this->sendError('Unauthorised', 401);
        }

        $playlistVideo = PlaylistVideo::findOrFail($playlistVideoId);
        if(!$user) {
            return $this->sendError('Playlist video not found', 404);
        }

        $playlistVideo->delete();
        return $this->sendResponse([], 'Video remove from playlist');
   }
}
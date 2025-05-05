<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlaylistVideo;
use Illuminate\Support\Facades\DB;


class PlaylistController extends Controller
{
    //

    public function index(Request $request) 
    {
        $rawData = PlaylistVideo::join('playlists', 'playlists.id', '=', 'playlist_video.playlist_id')
            ->join('videos', 'videos.id', '=', 'playlist_video.video_id')
            ->leftJoin('room_video', 'room_video.video_id', '=', 'videos.id')
            ->leftJoin('rooms', 'rooms.id', '=', 'room_video.room_id')
            ->select(
                'rooms.id as room_id',
                'rooms.name as room_name',
                'rooms.thumbnail as room_thumbnail',
                'rooms.description as room_description',
                'playlists.id as playlist_id',
                'videos.id as video_id',
                'videos.title as video_name',
                'videos.thumbnail as video_thumbnail',
                'videos.url as video_url',
            )
            ->get();
    
        // Regrouper par room
        $playlistVideos = $rawData->groupBy('room_id')->map(function ($items) {
            $first = $items->first();
            $videos = $items->map(function ($item) {
                return [
                    'video_id' => $item->video_id,
                    'video_name' => $item->video_name,
                    'video_thumbnail' => $item->video_thumbnail,
                    'video_url' => $item->video_url,
                ];
            });
        
            return [
                'room_id' => $first->room_id,
                'room_name' => $first->room_name,
                'room_thumbnail' => $first->room_thumbnail,
                'room_description' => $first->room_description,
                'playlist_id' => $first->playlist_id,
                'videos' => $videos,
                'video_count' => $videos->count(), 
            ];
        });
        
        return view('pages.playlist', compact('playlistVideos'));
    }
    
    

    public function show(Request $request, $roomId)
    {
        
        $playlistVideos = PlaylistVideo::join('playlists', 'playlists.id', '=', 'playlist_video.playlist_id')
            ->join('videos', 'videos.id', '=', 'playlist_video.video_id')
            ->join('room_video', 'room_video.video_id', '=', 'videos.id')
            ->join('rooms', 'rooms.id', '=', 'room_video.room_id')
            ->where('rooms.id', $roomId)
            ->select(
                'rooms.id',
                'rooms.name as room_name',
                'rooms.description as room_description',
                'rooms.thumbnail as room_thumbnail',
                'videos.id',
                'videos.name',
                'videos.thumbnail',
                'videos.url',
                'videos.created_at',
                DB::raw('COUNT(videos.id) as video_count')
            )
            ->groupBy(
                'rooms.id',
                'room_name',
                'room_description',
                'room_thumbnail',
                'videos.id', 
                'videos.name', 
                'videos.thumbnail', 
                'videos.url', 
                'videos.created_at'
            )
            ->get();

        return view('pages.playlist', compact('playlistVideos'));
    }


}

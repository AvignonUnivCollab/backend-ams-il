<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use App\Models\User;
use App\Models\UserRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoomController extends BaseController
{

    public function index(Request $request)
    {
        $user = $this->authenticate($request);

        if (!$user) {
            return $this->sendError(
                'Unauthorised.',
                401
            );
        }

        $rooms = Room::join('users', 'rooms.host_id', '=', 'users.id')
                ->leftJoin('messages', 'rooms.id', '=', 'messages.room_id')
                ->leftJoin('videos', 'videos.id', '=', 'rooms.current_video_id')
                ->leftJoin('user_room', 'rooms.id', '=', 'user_room.room_id')
                ->select(
                    'rooms.id',
                    'rooms.name',
                    'rooms.name',
                    'rooms.description',
                    'rooms.thumbnail',
                    'videos.url as video_url',
                    'videos.thumbnail as video_thumbnail',
                    'rooms.created_at',
                    'users.name as host_name',
                    DB::raw('COUNT(DISTINCT messages.id) as message_count'),
                    DB::raw('COUNT(DISTINCT user_room.id) as user_count'),
                    DB::raw('COUNT(DISTINCT videos.id) as video_count'),
                )
                ->groupBy(
                    'rooms.id', 
                    'rooms.name', 
                    'rooms.description',
                    'rooms.thumbnail', 
                    'video_url', 
                    'video_thumbnail',
                    'rooms.created_at',
                    'host_name')
                ->orderBy('rooms.created_at', 'desc')
                ->get();

                $rooms->transform(function ($room) use ($user) {
                    $room->thumbnail = asset('storage/' . $room->thumbnail);
                
                    $room->video_url = $room->video_url ? asset('storage/' . $room->video_url) : null;
                    $room->video_thumbnail = $room->video_thumbnail ? asset('storage/' . $room->video_thumbnail) : null;
                
                    $room->is_joined = DB::table('user_room')
                        ->where('room_id', $room->id)
                        ->where('user_id', $user->id)
                        ->exists();
                
                    return $room;
                });
                

        return $this
            ->sendResponse(
                $rooms->toArray(),
                'Rooms retrieved successfully.'
            );
    }

    public function show(Request $request, $roomId)
    {
        $user = $this->authenticate($request);

        if (!$user) {
            return $this->sendError(
                'Unauthorised.',
                401
            );
        }

        $room = Room::with(['host', 'users', 'videos','currentVideo', 'messages.sender', 'playlist.videos'])->findOrFail($roomId);
        return new RoomResource($room);
    }

    public function join(Request $request, $roomId)
    {

        $user = $this->authenticate($request);

        if (!$user) {
            return $this->sendError(
                'Unauthorised.',
                401
            );
        }

        //Salon nexiste pas
        $room = Room::findOrFail($roomId);
        if(!$room) {
            return $this
                ->sendError(
                    'Room not found.',
                    404
                );
        }

        //verifier si il est deja dans le salon
        if ($user->rooms()->where('rooms.id', $roomId)->exists()) {
            return $this
                ->sendError(
                    'Room is already joined.',
                    400
                );
        }

        $user->rooms()->attach($roomId, ['role' => 'membre']);
        return $this
            ->sendResponse(
                $room,
                'Room joined successfully.'
            );
    }



    public function leave(Request $request, $roomId)
    {

        $token = $request->bearerToken();

        if(!$token) {
            return $this
                ->sendError(
                    'Token not provided.',
                    401
                );
        }
        $user = JWTAuth::setToken($token)->authenticate();

        if(!$user) {
            return $this
                ->sendError(
                    'Unauthorised.',
                    401
                );
        }

        $room = Room::findOrFail($roomId);
        if(!$room) {
            return $this->sendError('room not found.', 404);
        }

        if (!$user->rooms()->where('rooms.id', $roomId)->exists()) {
            return $this
                ->sendError(
                    'Room is already leaved.',
                    400
                );
        }


        $user->rooms()->detach($roomId);
        return $this
            ->sendResponse(
                $room,
                'Room leave successfully.'
            );
    }

    public function store(Request $request)
    {
        // Validez la requete
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'videoUrl' => 'required|url', // Valider URL 
        ]);

        // Creer Room
        $room = Room::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? '',
            'videoUrl' => $validated['videoUrl'],  // Save the video URL to the database
        ]);

        return response()->json([
            'success' => true,
            'data' => $room,
            'message' => 'Room created successfully.',
        ]);
    }

}


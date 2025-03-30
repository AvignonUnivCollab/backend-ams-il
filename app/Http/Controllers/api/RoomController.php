<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\User;
use App\Models\UserRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoomController extends BaseController
{

    public function index()
    {
        $rooms = Room::join('users', 'rooms.host_id', '=', 'users.id')
            ->leftJoin('user_room', 'rooms.id', '=', 'user_room.room_id')
            ->leftJoin('messages', 'rooms.id', '=', 'messages.room_id')
            ->select(
                'rooms.id',
                'rooms.name',
                'rooms.thumbnail',
                'rooms.created_at',
                'users.name as host_name',
                DB::raw('COUNT(DISTINCT user_room.id) as user_count'),
                DB::raw('COUNT(DISTINCT messages.id) as message_count')
            )
            ->groupBy('rooms.id', 'rooms.name', 'rooms.thumbnail', 'rooms.created_at', 'users.name')
            ->orderBy('rooms.created_at', 'desc')
            ->get();

        return $this
            ->sendResponse(
                $rooms->toArray(),
                'Rooms retrieved successfully.'
            );
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
            return $this
                ->sendError(
                    'room not found.',
                    404
                );
        }

        if (!$user->rooms()->where('rooms.id', $roomId)->exists()) {
            return $this
                ->sendError(
                    'Room is already joined.',
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
}

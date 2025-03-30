<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\User;
use App\Models\UserRoom;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoomController extends BaseController
{

    public function index()
    {
        $rooms = Room::orderByDesc('created_at')->get();
        return $this
            ->sendResponse(
                $rooms,
            'Rooms retrieved successfully.'
        );
    }


    public function join(Request $request, $roomId)
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

        //Si user n'est pas connecter
        if(!$user) {
            return $this
                ->sendError(
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

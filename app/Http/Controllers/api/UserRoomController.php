<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\UserRoom;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserRoomController extends BaseController
{
    //
    public function rooms_join(Request $request)
    {

        $token = $request->bearerToken();
        if(!$token) {
            return $this
                ->sendError(
                    'Token not provided.',
                    400
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

        $user_rooms = UserRoom::join('rooms', 'rooms.id', '=', 'user_room.room_id')
            ->join('users', 'users.id', '=', 'user_room.user_id')
            ->where('user_room.user_id', $user->id)
            ->select(
                'user_room.*',
                'rooms.name as room_name',
                'users.name as user_name',
                'users.email as user_email',
                )
            ->get();

        return $this
                    ->sendResponse(
                        $user_rooms,
                        'user rooms join',
                    );
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

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

        //Si user n'est pas connecter
        if(!auth()->check()) {
            return $this
                ->sendError(
                    'Unauthorised.',
                    401
                );
        }

        //current user
        $user = auth()->user();

        //Salon nexiste pas
        $room = Room::find($roomId);
        if(!$room) {
            return $this
                ->sendError(
                    'Room not found.',
                    404
                );
        }

        //verifier si il est deja dans le salon
        if ($user->rooms->contains($roomId)) {
            return $this
                ->sendError(
                    'Room is already joined.',
                    400
                );
        }

        $user->rooms()->attach($roomId);
        return $this
            ->sendResponse(
                $room,
                'Room joined successfully.',
                200
            );
    }



    public function leave(Request $request, $roomId)
    {
        if(!auth()->check()) {
            return $this
                ->sendError(
                    'Unauthorised.',
                    401
                );
        }

        $user = auth()->user();

        $room = Room::findOrFail($roomId);
        if(!$room) {
            return $this
                ->sendError(
                    'room not found.',
                    404
                );
        }

        if (!$user->rooms->contains($roomId)) {
            return $this
                ->sendError(
                    'Room is already leave.',
                    400
                );
        }

        $user->rooms()->detach($roomId);
        return $this
            ->sendResponse(
                $room,
                'Room leave successfully.',
                200
            );
    }
}

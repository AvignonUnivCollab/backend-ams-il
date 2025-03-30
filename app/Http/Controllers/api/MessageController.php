<?php

namespace App\Http\Controllers\api;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Mailer\Event\MessageEvent;
use Tymon\JWTAuth\Facades\JWTAuth;

class MessageController extends BaseController
{
    //

    public function index(Request $request, $room_id)
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

        $room = Room::findOrFail($room_id);
        if (!$room) {
           return $this
               ->sendError(
                   'Room not found',
                   404
               );
        }

        $messages = Message::join('rooms', 'rooms.id', '=', 'messages.room_id')
            ->join('users', 'users.id', '=', 'rooms.host_id')
            ->select(
                'messages.content',
                'messages.created_at as sent_at',
                'rooms.name as room_name',
                'users.name as sender_name',
            )
            ->where('rooms.id', $room_id)
            ->orderBy('messages.created_at', 'desc')
            ->get();

        return $this
            ->sendResponse(
                $messages,
                'Messages retrieved successfully.'
            );
    }

    public function store(Request $request, $room_id) {

        $user = $this->authenticate($request);

        if (!$user) {
            return $this->sendError(
                'Unauthorised.',
                401
            );
        }

        $room = Room::findOrFail($room_id);
        if (!$room) {
            return $this
                ->sendError(
                    'Room not found',
                    404
                );
        }

        $request->validate(['message' => 'required|string|max:255']);

       $message = Message::create([
            'room_id' => $room_id,
            'sender_id' => $user->id,
            'content' => $request->message
        ]);

        broadcast(new MessageSent($message->content))->to('room-' . $room_id);

        Log::info('Message broadcasted', ['message' => $message]);

        return $this->sendResponse(
            $message,
            'Message sent successfully'
        );
    }
}

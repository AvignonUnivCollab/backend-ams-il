<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    //

    public function index() {

        $messages = Message::join('rooms', 'rooms.id', '=', 'messages.room_id')
            ->join('users', 'users.id', '=', 'rooms.host_id')
            ->select(
                'messages.content',
                'messages.created_at as sent_at',
                'rooms.name as room_name',
                'users.name as sender_name',
            )
            ->orderBy('messages.created_at', 'desc')
            ->get();

        return view('pages.message', compact('messages'));
    }
}

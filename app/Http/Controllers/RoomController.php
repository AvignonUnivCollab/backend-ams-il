<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    //

    public function index()
    {
        $rooms = Room::all();
        return view('room.index', compact('rooms'));
    }

    public function show($id)
    {
        $room = Room::with(['videos', 'messages'])->findOrFail($id);
        return view('room.show', compact('room'));
    }


    public function create() {
        return view('room.create');
    }

    public function store(Request $request) {

        $request->validate([
            'name' => 'required|string|max:60',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Room::created([
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
            'host_id' => Auth::user()->id,
            'current_video_id' => null,
            'is_playing' => false,
        ]);

        return redirect()->route('room.index');
    }

    public function update(Request $request, $roomId) {

        $room = Room::findOrFail($roomId);

        $request->validate([
            'name' => 'required|string|max:60',
            'description' => 'required|string',
            'thumbnail' => 'nullables|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('thumbnail')) {
            //supprimer l'ancienne image
            if($room->thumbnail) {
                Storage::disk('public')->delete($room->thumbnail);
            }
            $room->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $room->update([
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail' => $request->thumbnail,
        ]);

        return redirect()->route('room.show', $room->id);
    }
}

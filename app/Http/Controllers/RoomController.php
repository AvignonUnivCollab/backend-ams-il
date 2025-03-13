<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    //

    public function index()
    {
        $rooms = DB::table('rooms')
            ->leftJoin('room_video', 'rooms.id', '=', 'room_video.room_id')
            ->leftJoin('videos', 'room_video.video_id', '=', 'videos.id')
            ->select(
                'rooms.id',
                'rooms.name',
                'rooms.description',
                DB::raw('COUNT(DISTINCT videos.id) as video_count'),
                DB::raw('COALESCE(SUM(videos.duration), 0) as total_duration'),
            )
            ->groupBy('rooms.id', 'rooms.name', 'rooms.description')
            ->get();

        return view('pages.living-room', compact('rooms'));
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
            $file = $request->file('thumbnail');

            // Générer un nom unique basé sur le timestamp
            $timestamp = now()->format('Ymd_His');
            $extension = $file->getClientOriginalExtension(); // Récupère l'extension
            $filename = "image_{$timestamp}." . $extension;

            $thumbnailPath = $file->storeAs('images', $filename, 'public');
        }

        DB::table('rooms')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
            'host_id' => 1,
            'current_video_id' => null,
            'is_playing' => false,
        ]);

        return redirect()->route('pages.living-room')->with('success', 'Room crée avec success');
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

<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class RoomController extends Controller
{
    //

    public function index()
    {

        $rooms = Room::leftJoin('room_video', 'rooms.id', '=', 'room_video.room_id')
            ->leftJoin('videos', 'room_video.video_id', '=', 'videos.id')
            ->leftJoin('users', 'rooms.host_id', '=', 'users.id') // Jointure avec l'hôte
            ->select(
                'rooms.id',
                'rooms.name',
                'rooms.description',
                'rooms.thumbnail',
                'users.name as host_name',
                DB::raw('COUNT(DISTINCT videos.id) as video_count'),
                DB::raw('COALESCE(SUM(videos.duration), 0) as total_duration')
            )
            ->groupBy('rooms.id', 'rooms.name', 'rooms.description', 'rooms.thumbnail', 'users.name')
            ->get();

        $rooms->transform(function ($room) {
            $days = Carbon::parse($room->created_at)->diffInDays(Carbon::now());
            $room->formatted_creation_date = "il y a " . $days . " jours";
            return $room;
        });

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
            'host_id' => Auth::user()->id,
            'current_video_id' => null,
            'is_playing' => false,
            'created_at' => now(),
            'updated_at' => now(),
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
            if($room->thumbnail) {
                Storage::disk('public')->delete($room->thumbnail);
            }

            $fileUpload = $request->file('thumbnail');
            // Générer un nom unique basé sur le timestamp
            $timestamp = now()->format('Ymd_His');
            $extension = $fileUpload->getClientOriginalExtension(); // Récupère l'extension
            $filename = "image_{$timestamp}." . $extension;

            $thumbnailPath = $fileUpload->storeAs('images', $filename, 'public');
          } else {
            $thumbnailPath = $room->thumbnail;
        }


        $room->update([
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('pages.living-room')->with('success', 'Room modifier avec success');
    }
}

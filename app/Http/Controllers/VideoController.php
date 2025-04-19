<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Room;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\VideoCompressionService;


class VideoController extends Controller
{
    //
    protected $videoCompressionService;

    public function __construct(VideoCompressionService $videoCompressionService)
    {
        $this->videoCompressionService = $videoCompressionService;
    }

    public function index(Request $request) {
        $roomId = $request->query('id');

        // Vérifie si l'ID du salon existe
        $room = Room::find($roomId);

        if (!$room) {
            return redirect()->back()->with('error', 'Salon non trouvé.');
        }

        $videos = Video::join('room_video as rv', 'videos.id', '=', 'rv.video_id')
            ->join('categories', 'videos.category_id', '=', 'categories.id')
            ->select(
                'videos.title',
                'videos.description',
                'videos.url',
                'videos.thumbnail',
                'videos.duration',
                'categories.name',
                'rv.room_id'
            )
            ->where('rv.room_id', $roomId)
            ->get();

        $videos->transform(function ($video) {
            $video->thumbnail = asset('storage/' . $video->thumbnail);
            $video->url = asset('storage/' . $video->url);
            return $video;
        });

        $categories = Category::all();

        return view('pages.video', compact('videos', 'categories'));
    }



    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'title' => 'required|string|max:60',
        'description' => 'required|string',
        'url' => 'required|mimes:mp4,mov,avi', // Limit the file type
        'category_id' => 'required|integer',
        'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'duration' => 'required|integer',
        'room_id' => 'required|exists:rooms,id', // Ensure room ID exists
    ]);

    // Handle thumbnail upload
    $thumbnailPath = null;
    if ($request->hasFile('thumbnail')) {
        $file = $request->file('thumbnail');
        $timestamp = now()->format('Ymd_His');
        $extension = $file->getClientOriginalExtension();
        $filename = "image_{$timestamp}." . $extension;
        $thumbnailPath = $file->storeAs('images', $filename, 'public');
    }

    
    $compressedVideo = null;
    if ($request->hasFile('url')) {
        $compressedVideo = $this->videoCompressionService->compress($request->file('url'));

        // Ensure the compressed video is saved to the 'videos' folder
        $videoPath = $compressedVideo->store('videos', 'public'); 
    }

    // Store video data in the database
    $video = Video::create([
        'title' => $request->title,
        'description' => $request->description,
        'url' => $videoPath, 
        'category_id' => $request->category_id,
        'thumbnail' => $thumbnailPath,
        'duration' => $request->duration,
    ]);

    // Update the room with the current video ID
    Room::where('id', $request->room_id)->update(['current_video_id' => $video->id]);

    // Attach the video to the room
    $room = Room::findOrFail($request->room_id);
    $room->videos()->attach($video->id);

    return redirect()->back()->with('success', 'Vidéo ajoutée avec succès!');
}

}

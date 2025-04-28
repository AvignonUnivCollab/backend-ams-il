<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistVideo extends Model
{
    use HasFactory;

    protected $table = 'playlist_video';
    protected $fillable = [
        'playlist_id',
        'video_id',
        'order'
    ];

    public function playlist() 
    {
        return $this->belongsTo(Playlist::class);
    }

    public function video() 
    {
        return $this->belongsTo(Video::class);
   }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = ['room_id'];

    public function room() {
        return $this->belongsTo(Room::class);
    }

    public function videos() {
        return $this->belongsToMany(Video::class, 'playlist_video')->withPivot('order')->orderBy('order');
    }
}

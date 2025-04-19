<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoRoom extends Model
{
    use HasFactory;

    protected $table = 'room_video';
    protected $fillable = [
        'video_id',
        'room_id',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}

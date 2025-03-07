<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'thumbnail', 'host_id'];

    public function playlist()
    {
        return $this->hasOne(Playlist::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_room')->withPivot('role')->withTimestamps();
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'video_room')->withTimestamps();
    }

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }
}

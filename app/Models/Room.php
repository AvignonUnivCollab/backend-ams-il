<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'thumbnail', 'host_id', 'current_video_id', 'is_playing'];

    public function playlist()
    {
        return $this->hasOne(Playlist::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function users(): BelongsToMany
    {
        return $this
            ->belongsToMany(User::class, 'user_room')
            ->withTimestamps();
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'room_video')->withTimestamps();
    }

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    public function getTotalViewsAttribute()
    {
        return $this->videos()->sum('views');
    }
}

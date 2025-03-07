<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    //Visible row
    protected $fillable = [
        'title',
        'url',
        'description',
        'thumbnail',
        'duration',
        'category_id',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'video_room')->withTimestamps();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class);
    }

    public function singers()
    {
        return $this->belongsToMany(Singer::class);
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function Categories()
    {
        return $this->belongsToMany(Category::class);
    }
}

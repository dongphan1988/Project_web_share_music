<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{
    public function playlists()
    {
        return $this->hasMany('App\Playlist');
    }
}
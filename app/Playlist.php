<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function songs()
    {
        return $this->belongsToMany(Song::class);
    }

    public function mode()
    {
        return $this->belongsTo('App\Mode');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}

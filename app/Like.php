<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function song()
    {
        return $this->belongsTo('App\Song');
    }

    public function playlist()
    {
        return $this->belongsTo('App\Playlist');
    }
}

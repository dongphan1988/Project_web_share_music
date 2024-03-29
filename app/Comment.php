<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function playlist()
    {
        return $this->belongsTo('App\Playlist');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function singer()
    {
        return $this->belongsTo('App\Singer');
    }

    public function song()
    {
        return $this->belongsTo('App\Song');
    }
}

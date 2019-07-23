<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    const ADMIN = 1;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'birthday', 'gender', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function songs()
    {
        return $this->hasMany('App\Song');
    }

    public function isAdmin()
    {
        return $this->role_id == self::ADMIN;
    }

    public function playlists()
    {
        return $this->hasMany('App\Playlist');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function singers()
    {
        return $this->hasMany('App\Singer');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}

<?php

namespace Tests;

use App\Playlist;
use App\Song;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }

    public function createUserAdmin()
    {
        $user = new User();
        $user->name = "admin";
        $user->email = "admin@gmail.com";
        $user->password = Hash::make("admin@gmail.com");
        $user->save();

        return $user;
    }

    public function createSong()
    {
        $song = new Song();
        $song->name = 'Song01';
        $song->user_id = 1;
        $song->lyric = 'lyrics';
        $song->mp3_file = 'path/song';
        $song->save();

        return $song;
    }
    public function createPlaylist()
    {
        $playlist = new Playlist();
        $song->name = 'Song01';
        $song->user_id = 1;
        $song->lyric = 'lyrics';
        $song->mp3_file = 'path/song';
        $song->save();

        return $song;
    }
}

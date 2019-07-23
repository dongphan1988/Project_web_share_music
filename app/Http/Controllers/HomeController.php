<?php

namespace App\Http\Controllers;

use App\Service\PlaylistServiceInterface;
use App\Service\SongServiceInterface;
use App\Service\UserServiceInterface;
use App\Song;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $songService;
    protected $playlistService;

    public function __construct(SongServiceInterface $songService,
                                PlaylistServiceInterface $playlistService)

    {
        $this->songService = $songService;
        $this->playlistService = $playlistService;
        $this->middleware('isAdmin');
    }

    public function test(){
        $songs = Song::all();
        return response()->json([
            'status'=>'success',
            'data'=>$songs
        ]);
    }
    public function index()
    {
        $newSongs = $this->songService->getListNewSong();
        $songs = $this->songService->getSongsExists();
        $playlists = $this->playlistService->getPublicPlaylist();
        return view('home', compact('songs', 'newSongs', 'playlists'));
    }
}

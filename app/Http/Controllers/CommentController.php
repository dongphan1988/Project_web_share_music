<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Service\CommentServiceInterface;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public $commentService;

    public function __construct(CommentServiceInterface $commentService)
    {
        $this->commentService = $commentService;
    }

    public function createInPlaylist(CommentRequest $request, $playlistId)
    {
        $this->commentService->createInPlaylist($request, $playlistId);
        return redirect()->route('playlists.show', $playlistId);
    }

    public function createInSinger(CommentRequest $request, $singerId)
    {
        $this->commentService->createInSinger($request, $singerId);
        return redirect()->route('singers.showSongSinger', $singerId);
    }

    public function createInSong(CommentRequest $request, $songId)
    {
        $this->commentService->createInSong($request, $songId);
        return redirect()->route('songs.show', $songId);
    }
}

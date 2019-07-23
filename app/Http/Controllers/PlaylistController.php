<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaylistRequest;
use App\Playlist;
use App\Service\CommentServiceInterface;
use App\Service\LikeServiceInterface;
use App\Service\ModeServiceInterface;
use App\Service\PlaylistServiceInterface;
use App\Service\SongServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    protected $playlistService;
    protected $songService;
    protected $modeService;
    protected $commentService;
    protected $likeService;

    public function __construct(
        PlaylistServiceInterface $playlistService,
        SongServiceInterface $songService,
        ModeServiceInterface $modeService,
        CommentServiceInterface $commentService,
    LikeServiceInterface $likeService
    )
    {
        $this->playlistService = $playlistService;
        $this->songService = $songService;
        $this->modeService = $modeService;
        $this->commentService = $commentService;
        $this->likeService = $likeService;
    }

    public function index() // sửa lại thành showMyPlaylist()
    {
        $user = Auth::user();
        $playlists = $user->playlists()->get(); // Chuyển lại thành Reposity và Services
        return view('playlists.index', compact('playlists'));
    }

    public function create()
    {
        $userId = Auth::id();
        return view('playlists/create', compact('userId'));
    }

    public function store(PlaylistRequest $request)
    {
        $this->playlistService->create($request);
        Session::flash('message', 'tạo mới playlist thành công');
        return redirect()->route('playlists.create');
    }

    public function show($id)
    {
        $comments = $this->commentService->getListCommentByPlayListId($id);
        $playlist = $this->playlistService->findById($id);
        $songs = $this->songService->getSongsInPlaylist($playlist);
        return view('playlists/show', compact('playlist', 'songs', 'comments'));
    }

    public function edit($playlistId)
    {
        $playlist = $this->playlistService->findById($playlistId);
        $modes = $this->modeService->getAll();
        return view('playlists/update', compact('playlist', 'modes'));
    }

    public function update(PlaylistRequest $request, $playlistId)
    {
        $this->playlistService->update($request, $playlistId);
        Session::flash('message', "Cập nhật thành công playlist $request->name");
        return redirect()->route('playlists.index');
    }

    public function delete($playlistId)
    {
        // Viết thêm hàm delete() để xóa 1 playlist
    }

    public function deleteSongPlaylist($songId, $playlistId) // đổi tên là deleteSongInPlaylist
    {
        $this->playlistService->deleteSongPlaylist($songId, $playlistId);
        return redirect()->route('playlists.show', $playlistId);
    }

    public function getPublicPlaylist()
    {
        $playlists = $this->playlistService->getPublicPlaylist();
        return view('playlists.listPublicPlaylist', compact('playlists'));
    }

    public function searchPlaylistPublic(Request $request)
    {
        $keyword = $request->keyword;
        $playlists = $this->playlistService->searchPlaylistPublic($keyword);
        return view('playlists.search', compact('playlists'));
    }

    public function addSong(Request $request, $songId) // // đổi tên là addSongToPlaylist
    {
        $playlistId = $request->playlistId;
        $this->playlistService->addSong($playlistId, $songId);
        return redirect()->route('home');
    }

    public function createNewPlaylistAndAddSong(PlaylistRequest $request, $songId)
    {
        $this->playlistService->createNewPlaylistAndAddSong($request, $songId);
        return redirect()->route('home');
    }

    public function createLike($status, $playlistId)
    {
        if (!Auth::user()->likes->where('playlist_id', $playlistId)->first()) {
            $this->likeService->createLikePlaylist($status,$playlistId);
        } else {
            $like = Auth::user()->likes->where('playlist_id', $playlistId)->first();
            $like->like = $status;
            $this->likeService->updateLike($status,$like);
        }
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function like($playlistId)
    {
        $this->createLike(true, $playlistId);
    }

    public function dislike($playlistId)
    {
        $this->createLike(false, $playlistId);
    }
}

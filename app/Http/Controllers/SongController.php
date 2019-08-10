<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\SongRequest;
use App\Http\Requests\SongResquestUpdate;
use App\Service\CategoryServiceInterface;
use App\Service\Impl\SongService;
use App\Service\LikeServiceInterface;
use App\Service\PlaylistServiceInterface;
use App\Service\SongServiceInterface;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class SongController extends Controller
{
    protected $songService;
    protected $playlistService;
    protected $likeService;
    protected $categoryService;

    public function __construct(SongServiceInterface $songService,
                                PlaylistServiceInterface $playlistService,
                                LikeServiceInterface $likeService,
                                CategoryServiceInterface $categoryService
    )
    {
        $this->songService = $songService;
        $this->playlistService = $playlistService;
        $this->likeService = $likeService;
        $this->categoryService = $categoryService;
    }

    public function getListNewSong()
    {
        $songs = $this->songService->getListNewSong();
        return view('songs.listNewSongs', compact('songs'));
    }

    public function create()
    {
        $userId = Auth::id();
        return view('songs.create', compact('userId'));
    }

    public function store(SongRequest $request)
    {
        $this->songService->create($request);
        Session::flash('message', 'Tạo mới bài hát thành công!');
        return redirect()->route('songs.create');
    }

    public function show($id)
    {
        $song = $this->songService->findById($id);
        $song->view++;
        $this->songService->saveSongAfterChange($song);
        $categories = $this->categoryService->getAll();
        $comments = $song->comments()->get();
        return view('songs.show', compact('song', 'comments', 'categories'));
    }

    public function edit($id)
    {
        $song = $this->songService->findById($id);
        return view('songs.update', compact('song'));
    }

    public function update(SongResquestUpdate $request, $id)
    {
        $this->songService->update($request, $id);
        Session::flash('message', 'Cập nhật bài hát thành công');
        return redirect()->route('users.showMyLibrary');
    }

    public function delete($id)
    {
        $this->songService->destroy($id);
        return redirect()->route('users.showMyLibrary');
    }

    public function showListSongByUserId() // đổi là showListSongByUserId
    {
        $songs = $this->songService->getSongsInMyUser();
        return view('songs.index', compact('songs'));
    }

    public function searchByName(Request $request)
    {
        $keyword = $request->keyword;
        if (!$keyword) {
            Session::flash('message', 'Bạn phải nhập từ khóa!');
            return redirect()->back();
        }
        $songs = $this->songService->findByName($keyword);

        return view('songs.search', compact('songs'));
    }

    public function createLike($status, $songId)
    {
        if (!Auth::user()->likes->where('song_id', $songId)->first()) {
            $this->likeService->createLikeSong($status, $songId);
        } else {
            $like = Auth::user()->likes->where('song_id', $songId)->first();
            $like->like = $status;
            $this->likeService->updateLike($status, $like);
        }
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function like($songId)
    {
        $this->createLike(true, $songId);
    }

    public function dislike($songId)
    {
        $this->createLike(false, $songId);
    }

    public function addCategory(Request $request, $songId)
    {
        $categoryId = $request->categoryId;
        $song = $this->songService->findById($songId);
        $categoryExists = $this->songService->isCategoryExistsInSong($song, $categoryId);
        if ($categoryExists) {
            Session::flash('message', 'Bài hát đã có thể loại này');
        } else {
            $this->songService->addCategory($song, $categoryId);
            Session::flash('message', 'Thêm thể loại bài hát thành công');
        }
        return redirect()->route('songs.show', $songId);
    }

    public function showMostHearSongs()
    {
        $songs = $this->songService->mostHearSongs();
        return view('songs.mostHearSongs', compact('songs'));
    }
}

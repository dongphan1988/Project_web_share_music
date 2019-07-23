<?php

namespace App\Http\Controllers;

use App\Http\Requests\SingerRequest;
use App\Service\SingerServiceInterface;
use App\Service\SongServiceInterface;
use App\Singer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SingerController extends Controller
{
    protected $singerService;
    protected $songService;

    public function __construct(SingerServiceInterface $singerService,
    SongServiceInterface $songService
    )
    {
        $this->singerService = $singerService;
        $this->songService = $songService;
    }

    public function index()
    {
        $singers = $this->singerService->getListSinger();
        return view('singers.index', compact('singers'));
    }

    public function create()
    {
        $userId = Auth::id();
        return view('singers/create', compact('userId'));
    }

    public function store(SingerRequest $request)
    {
        $this->singerService->create($request);

        Session::flash('message', 'Tạo tên ca sĩ thành công');
        return view('singers.create');
    }

    public function addSong(Request $request)
    {
        $singerId = $request->singerId;
        $songId = $request->songId;
        $this->singerService->addSongSinger($singerId, $songId);
        return redirect()->route('users.showMyLibrary');
    }

    public function showSongSinger($singerId)
    {
        $singer = $this->singerService->findById($singerId);
        $songs = $this->songService->getSongsInSinger($singer);
        $comments = $singer->comments()->get();
        return view('singers.showSong', compact('songs', 'singer','comments'));
    }

    public function deleteSongInSinger($songId,$singerId)
    {
        $this->singerService->deleteSongInSinger($songId, $singerId);
        Session::flash('message', 'Xóa bài hát thành công');
        return redirect()->route('singers.showSongSinger', $singerId);
    }

    public function searchByName(Request $request)
    {
        $keyword = $request->keyword;
        if (!$keyword) {
            Session::flash('message', 'Bạn phải nhập từ khóa!');
            return redirect()->back();
        }
        $singers = $this->singerService->search($keyword);

        return view('singers.search', compact('singers'));
    }
    public function mySinger(){
        $singers = Auth::user()->singers()->paginate(8);
        return view('singers.mysinger',compact('singers'));
    }
}

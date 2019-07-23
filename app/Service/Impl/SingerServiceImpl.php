<?php


namespace App\Service\Impl;


use App\Repositories\SingerRepositoryInterface;
use App\Service\SingerServiceInterface;
use App\Service\SongServiceInterface;
use App\Singer;
use Illuminate\Support\Facades\Session;

class SingerServiceImpl extends ServiceImpl implements SingerServiceInterface
{
    protected $songService;

    public function __construct(SingerRepositoryInterface $singerRepository,
                                SongServiceInterface $songService)
    {
        $this->repository = $singerRepository;
        $this->songService = $songService;
    }

    public function create($request)
    {
        $singer = new Singer();
        $singer->name = $request->name;
        $singer->user_id = $request->user_id;
        if ($request->hasFile('image')) {
            $image = $request->image;
            $path = $image->store('images', 's3', 'public');
            $singer->image = $path;
        }
        $this->information = $request->information;
        $this->repository->create($singer);
    }


    public function search($keyword)
    {
        return $this->repository->search($keyword);
    }

    public function addSongSinger($singerId, $songId)
    {
        $singer = $this->repository->findById($singerId);
        $listSong = $singer->songs()->get();
        if ($this->isSongInSingerExists($songId, $listSong)) {
            Session::flash('message', 'Bài hát naỳ đã có trong ca sĩ của bạn');
        } else {
            $this->repository->addSong($singer, $songId);
            Session::flash('message', "Bạn đã thêm bài hát thành công vào ca sĩ $singer->name");
        }
    }

    public function isSongInSingerExists($songId, $listSong)
    {
        foreach ($listSong as $song) {
            if ($song['id'] == $songId) {
                return true;
            }
        }
        return false;
    }


    public function deleteSongInSinger($songId, $singerId)
    {
        $singer = $this->repository->findById($singerId);
        $this->repository->deleteSongInSinger($singer, $songId);
    }

    public function getListSinger()
    {
        return $this->repository->getListSinger();
    }

}

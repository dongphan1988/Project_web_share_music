<?php


namespace App\Repositories\Impl;


use App\Repositories\SingerRepositoryInterface;
use App\Singer;

class SingerRepositoryImpl extends RepositoryImpl implements SingerRepositoryInterface
{
    public function getModel()
    {
        return Singer::class;
    }

    public function search($keyword)
    {
        $singer = $this->model->where('name', 'like', '%' . $keyword . '%')->get();
        return $singer;
    }

    public function addSong($singer, $songId)
    {
        $singer->songs()->attach($songId);
    }

    public function getSongsInSinger($singer)
    {
        $songs = $singer->songs()->get();
        return $songs;
    }

    public function deleteSongInSinger($singer, $songId)
    {
        $singer->songs()->detach($songId);
    }

    public function getListSinger()
    {
        $singer = Singer::paginate(12);
        return $singer;
    }
}
<?php


namespace App\Repositories\Impl;


use App\Repositories\SongRepositoryInterface;
use App\Song;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SongRepositoryImpl extends RepositoryImpl implements SongRepositoryInterface
{
    public function getModel()
    {
        return Song::class;
    }

    public function getListNewSong()
    {
        $list = $this->model->whereNotNull('mp3_file')->orderBy('created_at', 'DESC')
            ->paginate(6);
        return $list;
    }

    public function search($keyword) // nên đổi là searchSongByName()
    {
        $songs = $this->model->where('name', 'like', '%' . $keyword . '%')->get();
        return $songs;
    }

    public function findSongByUserId($userId)
    {
        $list = $this->model->where('user_id', '=', $userId)->get();
        return $list;
    }

    public function deleteSongInStorage($song)
    {
        Storage::disk('s3')->delete($song->mp3_file);
        $song->mp3_file = null;
        $song->save();
    }

    public function addCategory($song, $categoryId)
    {
        $song->categories()->attach($categoryId);
    }

    public function removeCategory($song, $categoryId)
    {
        $song->categories()->detach($categoryId);
    }

    public function getSongsExists()
    {
        return $this->model->whereNotNull('mp3_file')->paginate(4);
    }

    public function getSongsInPlaylist($playlist)
    {
        return $playlist->songs()->paginate(4);
    }

    public function getSongsInMyUser()
    {
        return Auth::user()->songs()->WhereNotNull('mp3_file')->paginate(4);
    }

    public function getSongsInSinger($singer)
    {
        return $singer->songs()->paginate(4);
    }

    public function mostHearSongs()
    {
        $songs = $this->model->WhereNotNull('mp3_file')->orderBy('view', 'DESC')->paginate(10);
        return $songs;
    }
}

<?php


namespace App\Service\Impl;


use App\Repositories\SongRepositoryInterface;
use App\Service\SongServiceInterface;
use App\Song;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class SongService extends ServiceImpl implements SongServiceInterface
{
    public function __construct(SongRepositoryInterface $songRepository)
    {
        $this->repository = $songRepository;
    }

    // Gọi trên HomeController

    public function getListNewSong()
    {
        $songs = $this->repository->getListNewSong();
        return $songs;

    }

    public function create($request)
    {
        $newSong = new Song();
        $newSong->name = $request->name;
        $newSong->user_id = $request->user_id;
        $newSong->lyric = $request->lyric;
        if ($request->hasFile('image')) {
            $image = $request->image;
            $path = $image->store('images', 's3', 'public');
            $newSong->image = $path;
        }
        $mp3_file = $request->mp3_file;
        $path = $mp3_file->store('songs', 's3', 'public');
        $newSong->mp3_file = $path;

        $this->repository->create($newSong);
    }

    public function update($request, $id)
    {
        $newSong = $this->repository->findById($id);
        $newSong->name = $request->name;
        $newSong->lyric = $request->lyric;
        if ($request->hasFile('image')) {
            $currentImage = $newSong->image;
            if ($currentImage) {
                $isImageExists = Storage::disk('s3')->exists($currentImage);
                if ($isImageExists) {
                    Storage::disk('s3')->delete($currentImage);
                }
            }
            $image = $request->image;
            $path = $image->store('images', 's3', 'public');
            $newSong->image = $path;
        }

        if ($request->hasFile('mp3_file')) {
            $currentSong = $newSong->mp3_file;
            if ($currentSong) {
                $isSongExists = Storage::disk('s3')->exists($currentSong);
                if ($isSongExists) {
                    Storage::disk('s3')->delete($currentSong);
                }
            }
            $mp3_file = $request->mp3_file;
            $path = $mp3_file->store('songs', 's3', 'public');
            $newSong->mp3_file = $path;
        }
        $this->repository->update($newSong);
    }

    public function destroy($id)
    {
        $song = $this->repository->findById($id);
        $this->repository->deleteSongInStorage($song);
        Session::flash('message', 'xóa bài hát thành công');
    }

    public function findByName($keyword)
    {
        return $this->repository->search($keyword); // nên đổi là searchSongByName()
    }

    public function findSongByUserId($userId)
    {
        return $this->repository->findSongByUserId($userId);
    }

    public function addCategory($song, $categoryId)
    {
        $this->repository->addCategory($song, $categoryId);
    }

    public function removeCategory($song, $categoryId)
    {
        $this->repository->removeCategory($song, $categoryId);
    }

    public function saveSongAfterChange($song)
    {
        $this->repository->update($song);
    }

    public function isCategoryExistsInSong($song, $categoryId)
    {
        if ($song->categories->where('id', $categoryId)->first()) {
            return true;
        } else {
            return false;
        }
    }

    public function getSongsExists()
    {
        return $this->repository->getSongsExists();
    }

    public function getSongsInPlaylist($playlist)
    {
        return $this->repository->getSongsInPlaylist($playlist);
    }

    public function getSongsInMyUser()
    {
        return $this->repository->getSongsInMyUser();
    }

    public function getSongsInSinger($singer)
    {
        return $this->repository->getSongsInSinger($singer);
    }

    public function mostHearSongs()
    {
        return $this->repository->mostHearSongs();
    }

}

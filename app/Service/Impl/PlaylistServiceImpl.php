<?php


namespace App\Service\Impl;


use App\Playlist;
use App\Repositories\PlaylistRepositoryInterface;
use App\Repositories\SongRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Service\PlaylistServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PlaylistServiceImpl extends ServiceImpl implements PlaylistServiceInterface
{
    protected $userRepository;
    protected $songRepository;

    public function __construct(PlaylistRepositoryInterface $playlistRepository,
                                UserRepositoryInterface $userRepository,
                                SongRepositoryInterface $songRepository
    )
    {
        $this->repository = $playlistRepository;
        $this->userRepository = $userRepository;
        $this->songRepository = $songRepository;

    }

    public function create($request)
    {
        $playlist = new Playlist();
        $playlist->name = $request->name;
        $playlist->user_id = $request->user_id;
        if ($request->mode_id) {
            $playlist->mode_id = $request->mode_id;
        }
        $this->repository->create($playlist);
    }

    public function update($request, $id)
    {
        $playlist = $this->repository->findById($id);
        $playlist->name = $request->name;
        $playlist->user_id = Auth::id();
        $playlist->mode_id = $request->mode_id;
        $this->repository->update($playlist);
    }

    public function deleteSongPlaylist($songId, $playlistId)
    {
        $this->repository->deleteSongPlaylist($songId, $playlistId);
    }

    public function getPublicPlaylist()
    {
        return $this->repository->getPublicPlaylist();
    }

    public function searchPlaylistPublic($keyword) // đổi tên lại searchPublicPlaylist
    {
        return $this->repository->searchPlaylistPublic($keyword);
    }

    public function isNamePlaylistExists($name)
    {
        $playlists = Auth::user()->playlists()->get();
        foreach ($playlists as $playlist) {
            if ($playlist['name'] == $name) {
                return true;
            }
        }
        return false;
    }

    public function isSongInPlaylistExists($songId, $listSong)
    {
        foreach ($listSong as $song) {
            if ($song['id'] == $songId) {
                return true;
            }
        }
        return false;
    }

    public function findObjectByName($playlistName) // nên đặt tên là findPlaylistInMyUserByName
    {
        $playlists = Auth::user()->playlists()->get();
        foreach ($playlists as $playlist){
            if ($playlist->name == $playlistName){
                return $playlist;
            }
        }
    }

    public function addSong($playlistId, $songId)
    {
        $playlist = $this->repository->findById($playlistId);
        $listSong = $playlist->songs()->get();
        if ($this->isSongInPlaylistExists($songId, $listSong)) {
            Session::flash('message', 'Playlist của bạn đã có bài hát này');
        } else {
            $this->repository->addSong($playlistId, $songId);
            Session::flash('message', "Bạn đã thêm thành công vào playlist $playlist->name");
        }

    } // đổi tên là addSongToPlaylist

    public function createNewPlaylistAndAddSong($request, $songId) // đổi tên createNewPlaylistAndAddSongToPlaylist
    {
        $name = $request->name;
        if ($this->isNamePlaylistExists($name)) {
            Session::flash('message', "Playlist $name đã tồn tại, hãy chọn tên khác");
        } else {
            $this->create($request);
            $playlist = $this->findObjectByName($name);
            $playlistId = $playlist->id;
            $this->addSong($playlistId, $songId);
            Session::flash('message', "Khởi tạo playlist $name và thêm nhạc thành công");
        }
    }
}

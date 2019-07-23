<?php


namespace App\Repositories\Impl;


use App\Playlist;
use App\Repositories\PlaylistRepositoryInterface;

class PlaylistRepositoryImpl extends RepositoryImpl implements PlaylistRepositoryInterface
{
    const PUBLIC_MODE = 1;

    public function getModel()
    {
        return Playlist::class;
    }

    public function deleteSongPlaylist($songId, $playlistId)
    {
        $playlist = $this->model->findOrFail($playlistId); // cần để ở service
        $playlist->songs()->detach($songId);
    }

    public function getPublicPlaylist()
    {
        $playlists = $this->model->where('mode_id', '=', self::PUBLIC_MODE)->get();
        return $playlists;
    }

    public function searchPlaylistPublic($keyword) // đổi tên lại searchPublicPlaylist
    {
        $playlists = $this->model->where('mode_id', '=', self::PUBLIC_MODE)->where('name', 'like','%' . $keyword . '%')->get();
        return $playlists;
    }

    public function addSong($playlistId, $songId)
    {
        $playlist = $this->model->FindOrFail($playlistId); // cần để ở service
        $playlist->songs()->attach([$songId]);
    }
}

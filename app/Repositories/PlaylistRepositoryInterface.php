<?php


namespace App\Repositories;


interface PlaylistRepositoryInterface extends RepositoryInterface
{
    public function addSong($playlistId, $songId);

    public function getPublicPlaylist();

    public function deleteSongPlaylist($songId,$playlistId);

    public function searchPlaylistPublic($keyword);
}
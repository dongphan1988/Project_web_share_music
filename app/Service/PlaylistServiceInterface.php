<?php


namespace App\Service;


interface PlaylistServiceInterface extends ServiceInterface
{
    public function addSong($playlistId, $songId);

    public function findObjectByName($playlistName);

    public function createNewPlaylistAndAddSong($request, $songId);

    public function isNamePlaylistExists($name);

    public function getPublicPlaylist();

    public function isSongInPlaylistExists($songId, $listSong);

    public function deleteSongPlaylist($songId,$playlistId);

    public function searchPlaylistPublic($keyword);

}
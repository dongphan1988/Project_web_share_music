<?php


namespace App\Repositories;


interface SongRepositoryInterface extends RepositoryInterface
{
    public function getListNewSong();

    public function search($keyword);

    public function getSongsInMyUser();

    public function deleteSongInStorage($song);

    public function findSongByUserId($userId);

    public function addCategory($song, $categoryId);

    public function removeCategory($song, $categoryId);

    public function getSongsExists();

    public function getSongsInPlaylist($playlist);

    public function getSongsInSinger($singer);

    public function mostHearSongs();


}
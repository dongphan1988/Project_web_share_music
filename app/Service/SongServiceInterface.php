<?php


namespace App\Service;


interface SongServiceInterface extends ServiceInterface
{

    public function getListNewSong();

    public function getSongsInMyUser();

    public function findByName($keyword);

    public function findSongByUserId($userId);

    public function addCategory($song, $categoryId);

    public function removeCategory($song, $categoryId);

    public function saveSongAfterChange($song);

    public function isCategoryExistsInSong($song, $categoryId);

    public function getSongsInPlaylist($playlist);

    public function getSongsExists();

    public function getSongsInSinger($singer);

    public function mostHearSongs();


}
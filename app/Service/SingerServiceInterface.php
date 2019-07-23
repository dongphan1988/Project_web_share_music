<?php


namespace App\Service;


interface SingerServiceInterface extends ServiceInterface
{
    public function search($keyword);

    public function addSongSinger($singerId, $songId);

    public function isSongInSingerExists($songId, $listSong);

    public function deleteSongInSinger($songId, $singerId);

    public function getListSinger();
}
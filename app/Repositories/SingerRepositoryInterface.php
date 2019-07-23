<?php


namespace App\Repositories;


interface SingerRepositoryInterface extends RepositoryInterface
{
    public function search($keyword);

    public function addSong($singer, $songId);

    public function deleteSongInSinger($singer, $songId);

    public function getListSinger();
}
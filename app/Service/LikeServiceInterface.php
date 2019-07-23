<?php


namespace App\Service;


interface LikeServiceInterface extends ServiceInterface
{
    public function createLikeSong($status, $songId);

    public function updateLike($status, $like);

    public function createLikePlaylist($status, $playlistId);
}
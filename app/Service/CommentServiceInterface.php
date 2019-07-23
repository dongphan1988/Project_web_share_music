<?php


namespace App\Service;


interface CommentServiceInterface extends ServiceInterface
{
    public function getListCommentByPlayListId($playlistId);
    public function createInPlaylist($request,$playlistId);
    public function getListCommentBySingerId($singerId);
    public function createInSinger($request,$singerId);
    public function getListCommentBySongId($songId);
    public function createInSong($request,$songId);
}
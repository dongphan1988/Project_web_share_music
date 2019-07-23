<?php


namespace App\Repositories;


interface CommentRepositoryInterface extends RepositoryInterface
{
    public function getListCommentByPlayListId($playlistId);
    public function getListCommentBySingerId($singerId);
    public function getListCommentBySongId($songId);
}
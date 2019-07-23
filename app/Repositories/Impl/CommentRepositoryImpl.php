<?php


namespace App\Repositories\Impl;


use App\Comment;
use App\Repositories\CommentRepositoryInterface;

class CommentRepositoryImpl extends RepositoryImpl implements CommentRepositoryInterface
{

    public function getModel()
    {
        return Comment::class;
    }

    public function getListCommentByPlayListId($playlistId)
    {
       return $this->model->Where('playlist_id',$playlistId)->get();
    }
    public function getListCommentBySingerId($singerId)
    {
       return $this->model->Where('singer_id',$singerId)->get();
    }

    public function getListCommentBySongId($songId)
    {
        return $this->model->where('song_Id',$songId)->get();
    }
}
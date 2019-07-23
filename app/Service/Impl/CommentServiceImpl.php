<?php


namespace App\Service\Impl;


use App\Comment;
use App\Repositories\CommentRepositoryInterface;
use App\Repositories\Impl\CommentRepositoryImpl;
use App\Service\CommentServiceInterface;
use Illuminate\Support\Facades\Auth;

class CommentServiceImpl extends ServiceImpl implements CommentServiceInterface
{
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->repository = $commentRepository;
    }

    public function getListCommentByPlayListId($playlistId)
    {
        return $this->repository->getListCommentByPlayListId($playlistId);
    }

    public function createInPlaylist($request, $playlistId)
    {
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->playlist_id = $playlistId;
        $comment->user_id = $request->userId;
        $this->repository->create($comment);
    }

    public function getListCommentBySingerId($singerId)
    {
        return $this->repository->getListCommentBySingerId($singerId);
    }

    public function createInSinger($request, $singerId)
    {
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->singer_id = $singerId;
        $comment->user_id = $request->userId;
        $this->repository->create($comment);
    }


    public function getListCommentBySongId($songId)
    {
        return $this->repository->getListCommentBySongId($songId);
    }

    public function createInSong($request, $songId)
    {
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->song_id = $songId;
        $comment->user_id = $request->userId;
        $this->repository->create($comment);
    }
}
<?php


namespace App\Service\Impl;


use App\Like;
use App\Repositories\LikeRepositoryInterface;
use App\Service\LikeServiceInterface;
use Illuminate\Support\Facades\Auth;

class LikeServiceImpl extends ServiceImpl implements LikeServiceInterface
{

    public function __construct(LikeRepositoryInterface $likeRepository)
    {
        $this->repository = $likeRepository;
    }

    public function createLikeSong($status, $songId)
    {
        $like = new Like();
        $like->song_id = $songId;
        $like->user_id = Auth::id();
        $like->like = $status;
        $this->repository->create($like);
    }

    public function updateLike($status, $like)
    {
        $like->like = $status;
        $this->repository->update($like);
    }

    public function createLikePlaylist($status, $playlistId)
    {
        $like = new like();
        $like->playlist_id = $playlistId;
        $like->user_id = Auth::id();
        $like->like = $status;
        $this->repository->create($like);
    }
}
<?php


namespace App\Repositories\Impl;


use App\Like;
use App\Repositories\LikeRepositoryInterface;

class LikeRepositoryImpl extends RepositoryImpl implements LikeRepositoryInterface
{
    public function getModel()
    {
        return Like::class;
    }

}
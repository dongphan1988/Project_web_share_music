<?php


namespace App\Repositories\Impl;


use App\Repositories\UserRepositoryInterface;
use App\User;

class UserRepositoryImpl extends RepositoryImpl implements UserRepositoryInterface
{
    public function getModel()
    {
        $model = User::class;
        return $model;
    }

}
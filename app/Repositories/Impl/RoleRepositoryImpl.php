<?php


namespace App\Repositories\Impl;


use App\Repositories\RoleRepositoryInterface;
use App\Role;

class RoleRepositoryImpl extends RepositoryImpl implements RoleRepositoryInterface
{
    public function getModel()
    {
        return Role::class;
    }
}
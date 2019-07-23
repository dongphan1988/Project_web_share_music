<?php


namespace App\Repositories\Impl;


use App\Mode;
use App\Repositories\ModeRepositoryInterface;

class ModeRepositoryImpl extends RepositoryImpl implements ModeRepositoryInterface
{

    public function getModel()
    {
        return Mode::class;
    }
}
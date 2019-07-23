<?php


namespace App\Service\Impl;


use App\Repositories\ModeRepositoryInterface;
use App\Service\ModeServiceInterface;

class ModeServiceImpl extends ServiceImpl implements ModeServiceInterface
{
    public function __construct(ModeRepositoryInterface $modeRepository)
    {
        $this->repository = $modeRepository;
    }
}
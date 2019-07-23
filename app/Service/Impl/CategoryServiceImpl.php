<?php


namespace App\Service\Impl;


use App\Repositories\CategoryRepositoryInterface;
use App\Service\CategoryServiceInterface;

class CategoryServiceImpl extends ServiceImpl implements CategoryServiceInterface
{
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }
}
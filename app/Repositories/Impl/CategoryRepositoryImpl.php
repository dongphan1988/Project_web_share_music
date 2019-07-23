<?php


namespace App\Repositories\Impl;


use App\Category;
use App\Repositories\CategoryRepositoryInterface;

class CategoryRepositoryImpl extends RepositoryImpl implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }
}
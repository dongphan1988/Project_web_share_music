<?php

namespace App\Service\Impl;

use App\Service\ServiceInterface;
use Illuminate\Support\Facades\Session;

class ServiceImpl implements ServiceInterface
{
    protected $repository;

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function findById($id)
    {
        return $this->repository->findById($id);
    }

    public function destroy($id)
    {
        $object = $this->repository->findById($id);
        $this->repository->destroy($object);
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function create($request)
    {
        // TODO: Implement create() method.
    }
}
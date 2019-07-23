<?php

namespace App\Repositories\Impl;

use App\Repositories\RepositoryInterface;

abstract class RepositoryImpl implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    public function getAll()
    {
        $result = $this->model->all();
        return $result;
    }

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function destroy($object)
    {
        $object->delete();
    }

    public function update($object)
    {
        $object->save();
    }

    public function create($object)
    {
        $object->save();
    }
}
<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function getAll();

    public function findById($id);

    public function destroy($object);

    public function update($object);

    public function create($object);
}
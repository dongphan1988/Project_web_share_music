<?php

namespace App\Service;

interface ServiceInterface
{
    public function getAll();

    public function findById($id);

    public function destroy($id);

    public function update($request, $id);

    public function create($request);
}
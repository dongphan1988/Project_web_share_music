<?php


namespace App\Service\Impl;


use App\Repositories\UserRepositoryInterface;
use App\Service\UserServiceInterface;

class UserServiceImpl extends ServiceImpl implements UserServiceInterface
{
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function update($request, $id)
    {
        $profileUser = $this->repository->findById($id);
        $profileUser->name = $request->name;
        $profileUser->birthday = $request->birthday;
        $profileUser->gender = $request->gender;
        if ($request->hasFile('image')) {
            $image = $request->image;
            $path = $image->store('images', 's3', 'public');
            $profileUser->image = $path;
        }
        $this->repository->update($profileUser);
    }
}
<?php

namespace App\Http\Controllers;

use App\Service\UserServiceInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('admin.index');
    }

    public function showUser()
    {
        $users = $this->userService->getAll();
        return view('admin.showUser', compact('users'));
    }
}

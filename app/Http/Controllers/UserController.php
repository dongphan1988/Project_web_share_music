<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Service\PlaylistServiceInterface;
use App\Service\SongServiceInterface;
use App\Service\UserServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $userService;
    protected $songService;
    protected $playlistService;

    public function __construct(UserServiceInterface $userService,
                                SongServiceInterface $songService,
                                PlaylistServiceInterface $playlistService)
    {
        $this->userService = $userService;
        $this->songService = $songService;
        $this->playlistService = $playlistService;
    }

    public function editProfile($id)
    {
        $user = $this->userService->findById($id);
        return view('users.update', compact('user'));
    }

    public function index($id)
    {
        $user = $this->userService->findById($id);
        return view('users.showProfile', compact('user'));
    }

    public function updateProfile(UserRequest $request, $id)
    {
        $this->userService->update($request, $id);
        Session::flash('message', 'Cập nhật thông tin thành công');
        return redirect()->route('user.index', $id);
    }

    public function showMyLibrary()
    {
        $songs = $this->songService->getSongsInMyUser();
        return view('users.index', compact('songs'));
    }

}

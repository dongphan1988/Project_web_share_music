<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ChangePasswordController extends Controller
{
    public function changePassword()
    {
        return view('auth.passwords.change');
    }


    protected function changePasswordUser(ChangePasswordRequest $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            Session::flash("pass-error", "Mật khẩu hiện tại không khớp với mật khẩu cũ.");
            return redirect()->back();
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            return redirect()->back();
        }

        if (strcmp($request->get('new-password'), $request->get('password-confirmation')) != 0) {
            return redirect()->back();
        }

        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        Session::flash("message", "Thay đổi mật khẩu thành công !");
        $user->save();
        return redirect()->route('home');

    }

}
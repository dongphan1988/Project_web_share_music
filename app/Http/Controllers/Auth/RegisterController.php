<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $message = array(
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không quá 20 ký tự',
            'name.min' => 'Tên ít nhất phải 4 kí tự',
            'name.regex' => 'Tên sai định dạng',
            'email.unique' => 'Email đã được sử dụng',
            'email.min' => 'Email ít nhất phải 4 kí tự',
            'email.max' => 'Email không qúa 32 kí tự',
            'email.required' => 'Email không được để trống',
            'email.regex' => 'Email không đúng định dạng',
            'password.min' => 'Mật khẩu ít nhất 6 kí tự',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',

        );
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:20', 'min:4', 'regex:/^[a-zA-Z][^#&<>\"~;$^%{}?@!]{1,20}$/'],
            'email' => ['required', 'string', 'email', 'min:4', 'max:32', 'regex:/^[a-z][a-z0-9_\.]{3,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}/', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], $message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        Session::flash('message', 'Đăng ký thành công');
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}

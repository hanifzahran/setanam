<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('username', $request->username)->first();
        if($user->username == $request->username && Hash::check($request->password, $user->password) && $user->role == 0){
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->intended('/');
            }
        }

        return back();
    }

    public function register(){
        return view('auth.register');
    }

    public function registered(Request $request){
        $request->validate([
            "username" => "required|unique:users,username",
            "email" => "required|unique:users,email",
            "address" => "required",
            "fullname" => "required",
            "password" => "required",
        ]);
        $data = [
            "username" => $request->username,
            "email" => $request->email,
            "address" => $request->address,
            "fullname" => $request->fullname,
            "password" => Hash::make($request->password)
        ];
        User::create($data);

        return redirect('/login');
    }
}

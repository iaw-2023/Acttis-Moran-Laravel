<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
use AuthenticatesUsers;

/**
* Where to redirect users after login.
*
* @var string
*/
protected $redirectTo = '/home';

/**
* Create a new controller instance.
*
* @return void
*/
public function __construct()
{
$this->middleware('guest')->except('logout');
}

    /**
    * Show the application's login form.
    *
    * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    */
    public function showLoginForm(){
        return view('login');
    }

    /*public function check(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $password = \Hash::make($request->password);
        print($credentials['password']);
        if (Auth::attempt($credentials))
        {
            return "<h2>Username or Password valid!</h2>";
        }
        return "<h2>Username or Password Invalid!</h2>";
    }*/
}

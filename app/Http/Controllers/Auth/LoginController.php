<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
}

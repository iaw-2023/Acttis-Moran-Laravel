<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
use AuthenticatesUsers;


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

   public function login(){
        $credentials = request(['email', 'password']);

        if (Auth::attempt($credentials)){
            return redirect('/home');
        }
        else{
            return $this->sendFailedLoginResponse();
        }
    }

    protected function sendFailedLoginResponse()
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }


}

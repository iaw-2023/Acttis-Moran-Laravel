<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * Where to redirect users after unlogin.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('home');
    }

    public function logout(){
        auth('web')->logout();
        return redirect('/login');
    }





}

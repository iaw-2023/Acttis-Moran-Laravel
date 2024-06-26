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
        $this->middleware('auth');
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
        auth()->logout();
        return redirect('/login');
    }





}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('contact', 'index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //dd(Auth::id());  //returns the user id in mysql
        //dd(Auth::user());  //returns a model of the currently logged in / authenticated user
        //dd(Auth::check());  //returns a boolean of current user:  is logged in and authenticated = true

        return view('home.index');
    }

//    public function home()
//    {
//        // dd(Auth::id());  NB does not find this but above does
//        return view('home.index');
//    }

	public function contact()
    {
      return view('home.contact');
    }

    public function secret()
    {
        return view('home.secret');
    }
}

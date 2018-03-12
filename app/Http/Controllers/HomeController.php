<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $this->user =  \Auth::user();
        pr(Auth::user()->name);
        if ($this->user->isAdmin()) {
            echo 'admin';
        }
//            pr($request->user()->id);
        return view('home');
    }

    public function test()
    {       
        $this->user =  \Auth::user();
        pr(Auth::user()->name);
        if ($this->user->isAdmin()) {
            echo 'admin';
        }
//            pr($request->user()->id);
        return view('home');
    }
}

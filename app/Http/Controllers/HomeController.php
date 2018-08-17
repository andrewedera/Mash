<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $data['campaign'] = \App\Campaign::count();
        $data['domain'] = \App\Domain::count();
        $data['server'] = \App\Server::count();
        return view('dashboard', compact('data'));
    }
}
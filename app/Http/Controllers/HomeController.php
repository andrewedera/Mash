<?php

namespace App\Http\Controllers;

use Auth;
use App\Campaign;
use App\Domain;
use App\Server;
use App\Setting;
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
        $data['campaign'] = Campaign::where('user_id',Auth::id())->count();
        $data['domain'] = Domain::where('user_id',Auth::id())->count();
        $data['server'] = Server::where('user_id',Auth::id())->count();
        $data['rotator'] = Setting::select('setting_value')->where('user_id',Auth::id())->where('setting_name', 'setting_isRotate')->first();
        return view('dashboard', compact('data'));
    }
}
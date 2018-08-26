<?php

namespace App\Http\Controllers;

use Auth;
use App\Server;
use App\Http\Resources\ServerResource;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'server_ip' => 'required',
            'server_password' => 'required',
            'server_type' => 'required',
            'server_username' => 'required',
        ]);

        $server = Auth::user()->server()->updateOrCreate([
            'campaign_id' => $request['campaign_id']
        ],[
            'campaign_id' => $request['campaign_id'],
            'name' => $request['name'],
            'server_ip' => $request['server_ip'],
            'server_password' => $request['server_password'],
            'server_type' => $request['server_type'],
            'server_username' => $request['server_username']
        ]);

        return new ServerResource($server);
    }
}
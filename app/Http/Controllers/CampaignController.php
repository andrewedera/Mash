<?php

namespace App\Http\Controllers;

use Auth;
use App\Campaign;
use App\Domain;
use App\Server;
use App\Http\Resources\CampaignResource;
use App\Http\Resources\DomainResource;
use App\Http\Resources\ServerResource;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $campaign = Campaign::withCount('domains')->where('user_id',Auth::id())->get();
        return CampaignResource::collection($campaign);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:campaigns',
        ]);

        $campaign = new Campaign(['name' => $request->name]);

        $campaign = Auth::user()->campaign()->save($campaign);

        return CampaignResource::collection($campaign::withCount('domains')->where('user_id',Auth::id())->get());
    }

    public function edit(Campaign $campaign)
    {
        $domain = Domain::where('campaign_id', $campaign['id'])
                ->where('user_id',Auth::id())
                ->orderBy('is_active','desc')
                ->orderBy('is_used','asc')
                ->with('campaign')
                ->get();

        $server = Server::where('campaign_id', $campaign['id'])->where('user_id',Auth::id())->first();

        return (DomainResource::collection($domain))
                ->additional([
                    'campaign_id' => $campaign->id,
                    'campaign' => $campaign->name,
                    'server' => (!is_null($server)) ? new ServerResource($server) : null,
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        $Campaigns = Campaign::withCount('domains')
                    ->where('id', $campaign['id'])
                    ->where('user_id',Auth::id())->first();
        //$Campaigns = Campaign::withCount('domains')->findOrFail($campaign['id']);
        if ($request->has('name')) {
            $Campaigns->name = $request['name'];
        }
        if ($request->has('toggleStatus')) {
            $Campaigns->toggleStatus();
        }
        $Campaigns->save();
        return new CampaignResource($Campaigns);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        if ($campaign->user_id == Auth::id()) {
            $campaign->delete();
            return response()->json(null, 204);
        }
        else
            return response()->json(['data' => 'Permission not allowed'], 400);
    }
}

<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Http\Resources\Campaign as CampaignResource;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('campaigns');
    }

    public function index()
    {
        $campaign = Campaign::all();
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
        $Campaign = new Campaign;
        $Campaign->name = $request->name;
        $Campaign->save();
        return new CampaignResource($Campaign);
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
        $Campaigns = Campaign::findOrFail($campaign['id']);
        $Campaigns->name = $request['name'];
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
        $campaign->delete();
    }
}

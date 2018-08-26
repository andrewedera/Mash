<?php

namespace App\Http\Controllers;

use Auth;
use App\Domain;
use App\Http\Resources\DomainResource;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
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
            'name' => 'required|unique:domains',
        ]);

        $Domain = new Domain([
            'name' => $request->name,
            'campaign_id' => $request->campaign_id,
            'is_used' => false,
            'is_active' => false,
        ]);

        $Domain = Auth::user()->domain()->save($Domain);
        
        return new DomainResource($Domain);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Domain $domain)
    {
        $Domains = Domain::where('id', $domain['id'])
                    ->where('user_id',Auth::id())->first();

        if ($request->has('name')) {
            $Domains->name = $request['name'];
        }
        if ($request->has('toggleStatus')) {
            if (Domain::where('is_active', true)
                ->where('is_used', false)
                ->where('user_id',Auth::id())
                ->where('id', '<>', $domain['id'])
                ->where('campaign_id', $Domains['campaign_id'])
                ->count() >= 1)
                return response()->json(['data' => 'Only 1 active domain per campaign is allowed'], 400);
            else
                $Domains->toggleStatus();
        }
        $Domains->save();
        return new DomainResource($Domains);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domain $domain)
    {
        if ($domain->user_id == Auth::id()) {
            $domain->delete();
            return response()->json(null, 204);
        }
        else
            return response()->json(['data' => 'Permission not allowed'], 400);
    }
}

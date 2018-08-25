<?php

namespace App\Http\Controllers;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $Domain = Domain::create([
            'name' => $request->name,
            'campaign_id' => $request->campaign_id,
            'is_used' => false,
            'is_active' => false,
        ]);
        return new DomainResource($Domain);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function show(Domain $domain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function edit(Domain $domain)
    {
        //
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
        $Domains = Domain::findOrFail($domain['id']);
        if ($request->has('name')) {
            $Domains->name = $request['name'];
        }
        if ($request->has('toggleStatus')) {
            if (Domain::where('is_active', true)
                ->where('is_used', false)
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
        $domain->delete();
        return response()->json(null, 204);
    }
}

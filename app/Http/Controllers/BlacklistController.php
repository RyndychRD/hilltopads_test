<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlacklistResourse;
use App\Models\Advertiser;
use App\Models\Blacklist;
use App\Models\Publisher;
use App\Models\Site;
use App\Services\Blacklists;
use Illuminate\Http\Request;
use Mockery\Exception;

class BlacklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return BlacklistResourse|Exception|string
     */


    public function store(Request $request)
    {
        return Blacklists::save(
            $request->input('input_line'),
            $request->input('advertiser_id')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Blacklist $blacklist
     * @return false|\Illuminate\Http\Resources\Json\AnonymousResourceCollection|string
     */
    public function show($advertiserId)
    {
        return Blacklists::get($advertiserId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Blacklist $blacklist
     * @return \Illuminate\Http\Response
     */
    public function edit(Blacklist $blacklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Blacklist $blacklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blacklist $blacklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Blacklist $blacklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blacklist $blacklist)
    {
        //
    }
}

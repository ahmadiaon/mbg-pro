<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreyoutubeRequest;
use App\Http\Requests\UpdateyoutubeRequest;
use App\Models\youtube;

class YoutubeController extends Controller
{
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
     * @param  \App\Http\Requests\StoreyoutubeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreyoutubeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\youtube  $youtube
     * @return \Illuminate\Http\Response
     */
    public function show(youtube $youtube)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\youtube  $youtube
     * @return \Illuminate\Http\Response
     */
    public function edit(youtube $youtube)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateyoutubeRequest  $request
     * @param  \App\Models\youtube  $youtube
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateyoutubeRequest $request, youtube $youtube)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\youtube  $youtube
     * @return \Illuminate\Http\Response
     */
    public function destroy(youtube $youtube)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pit;
use App\Http\Requests\StorePitRequest;
use App\Http\Requests\UpdatePitRequest;

class PitController extends Controller
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
     * @param  \App\Http\Requests\StorePitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePitRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pit  $pit
     * @return \Illuminate\Http\Response
     */
    public function show(Pit $pit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pit  $pit
     * @return \Illuminate\Http\Response
     */
    public function edit(Pit $pit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePitRequest  $request
     * @param  \App\Models\Pit  $pit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePitRequest $request, Pit $pit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pit  $pit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pit $pit)
    {
        //
    }
}

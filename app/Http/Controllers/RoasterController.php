<?php

namespace App\Http\Controllers;

use App\Models\Roaster;
use App\Http\Requests\StoreRoasterRequest;
use App\Http\Requests\UpdateRoasterRequest;

class RoasterController extends Controller
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
     * @param  \App\Http\Requests\StoreRoasterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoasterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Roaster  $roaster
     * @return \Illuminate\Http\Response
     */
    public function show(Roaster $roaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Roaster  $roaster
     * @return \Illuminate\Http\Response
     */
    public function edit(Roaster $roaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoasterRequest  $request
     * @param  \App\Models\Roaster  $roaster
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoasterRequest $request, Roaster $roaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Roaster  $roaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roaster $roaster)
    {
        //
    }
}

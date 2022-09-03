<?php

namespace App\Http\Controllers;

use App\Models\Mine;
use App\Http\Requests\StoreMineRequest;
use App\Http\Requests\UpdateMineRequest;

class MineController extends Controller
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
     * @param  \App\Http\Requests\StoreMineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMineRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mine  $mine
     * @return \Illuminate\Http\Response
     */
    public function show(Mine $mine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mine  $mine
     * @return \Illuminate\Http\Response
     */
    public function edit(Mine $mine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMineRequest  $request
     * @param  \App\Models\Mine  $mine
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMineRequest $request, Mine $mine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mine  $mine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mine $mine)
    {
        //
    }
}

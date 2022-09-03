<?php

namespace App\Http\Controllers;

use App\Models\Poh;
use App\Http\Requests\StorePohRequest;
use App\Http\Requests\UpdatePohRequest;

class PohController extends Controller
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
     * @param  \App\Http\Requests\StorePohRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePohRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poh  $poh
     * @return \Illuminate\Http\Response
     */
    public function show(Poh $poh)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poh  $poh
     * @return \Illuminate\Http\Response
     */
    public function edit(Poh $poh)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePohRequest  $request
     * @param  \App\Models\Poh  $poh
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePohRequest $request, Poh $poh)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poh  $poh
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poh $poh)
    {
        //
    }
}

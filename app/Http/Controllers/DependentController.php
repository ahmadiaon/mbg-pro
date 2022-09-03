<?php

namespace App\Http\Controllers;

use App\Models\Dependent;
use App\Http\Requests\StoreDependentRequest;
use App\Http\Requests\UpdateDependentRequest;

class DependentController extends Controller
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
     * @param  \App\Http\Requests\StoreDependentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDependentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dependent  $dependent
     * @return \Illuminate\Http\Response
     */
    public function show(Dependent $dependent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dependent  $dependent
     * @return \Illuminate\Http\Response
     */
    public function edit(Dependent $dependent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDependentRequest  $request
     * @param  \App\Models\Dependent  $dependent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDependentRequest $request, Dependent $dependent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dependent  $dependent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dependent $dependent)
    {
        //
    }
}

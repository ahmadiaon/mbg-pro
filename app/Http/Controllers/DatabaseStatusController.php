<?php

namespace App\Http\Controllers;

use App\Models\DatabaseStatus;
use App\Http\Requests\StoreDatabaseStatusRequest;
use App\Http\Requests\UpdateDatabaseStatusRequest;

class DatabaseStatusController extends Controller
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
     * @param  \App\Http\Requests\StoreDatabaseStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDatabaseStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DatabaseStatus  $databaseStatus
     * @return \Illuminate\Http\Response
     */
    public function show(DatabaseStatus $databaseStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DatabaseStatus  $databaseStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(DatabaseStatus $databaseStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDatabaseStatusRequest  $request
     * @param  \App\Models\DatabaseStatus  $databaseStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDatabaseStatusRequest $request, DatabaseStatus $databaseStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DatabaseStatus  $databaseStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(DatabaseStatus $databaseStatus)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\SafetyEmployee;
use App\Http\Requests\StoreSafetyEmployeeRequest;
use App\Http\Requests\UpdateSafetyEmployeeRequest;

class SafetyEmployeeController extends Controller
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
     * @param  \App\Http\Requests\StoreSafetyEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSafetyEmployeeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SafetyEmployee  $safetyEmployee
     * @return \Illuminate\Http\Response
     */
    public function show(SafetyEmployee $safetyEmployee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SafetyEmployee  $safetyEmployee
     * @return \Illuminate\Http\Response
     */
    public function edit(SafetyEmployee $safetyEmployee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSafetyEmployeeRequest  $request
     * @param  \App\Models\SafetyEmployee  $safetyEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSafetyEmployeeRequest $request, SafetyEmployee $safetyEmployee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SafetyEmployee  $safetyEmployee
     * @return \Illuminate\Http\Response
     */
    public function destroy(SafetyEmployee $safetyEmployee)
    {
        //
    }
}

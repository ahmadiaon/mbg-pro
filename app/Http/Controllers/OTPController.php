<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOTPRequest;
use App\Http\Requests\UpdateOTPRequest;
use App\Models\OTP;

class OTPController extends Controller
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
     * @param  \App\Http\Requests\StoreOTPRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOTPRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OTP  $oTP
     * @return \Illuminate\Http\Response
     */
    public function show(OTP $oTP)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OTP  $oTP
     * @return \Illuminate\Http\Response
     */
    public function edit(OTP $oTP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOTPRequest  $request
     * @param  \App\Models\OTP  $oTP
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOTPRequest $request, OTP $oTP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OTP  $oTP
     * @return \Illuminate\Http\Response
     */
    public function destroy(OTP $oTP)
    {
        //
    }
}

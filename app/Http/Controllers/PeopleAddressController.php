<?php

namespace App\Http\Controllers;

use App\Models\PeopleAddress;
use App\Http\Requests\StorePeopleAddressRequest;
use App\Http\Requests\UpdatePeopleAddressRequest;

class PeopleAddressController extends Controller
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
     * @param  \App\Http\Requests\StorePeopleAddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePeopleAddressRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PeopleAddress  $peopleAddress
     * @return \Illuminate\Http\Response
     */
    public function show(PeopleAddress $peopleAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PeopleAddress  $peopleAddress
     * @return \Illuminate\Http\Response
     */
    public function edit(PeopleAddress $peopleAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePeopleAddressRequest  $request
     * @param  \App\Models\PeopleAddress  $peopleAddress
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePeopleAddressRequest $request, PeopleAddress $peopleAddress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PeopleAddress  $peopleAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeopleAddress $peopleAddress)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\EmployeeRoaster;
use App\Http\Requests\StoreEmployeeRoasterRequest;
use App\Http\Requests\UpdateEmployeeRoasterRequest;

class EmployeeRoasterController extends Controller
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
     * @param  \App\Http\Requests\StoreEmployeeRoasterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRoasterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeRoaster  $employeeRoaster
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeRoaster $employeeRoaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeRoaster  $employeeRoaster
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeRoaster $employeeRoaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRoasterRequest  $request
     * @param  \App\Models\EmployeeRoaster  $employeeRoaster
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRoasterRequest $request, EmployeeRoaster $employeeRoaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeRoaster  $employeeRoaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeRoaster $employeeRoaster)
    {
        //
    }
}

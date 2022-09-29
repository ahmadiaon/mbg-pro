<?php

namespace App\Http\Controllers;

use App\Models\EmployeeCompany;
use App\Http\Requests\StoreEmployeeCompanyRequest;
use App\Http\Requests\UpdateEmployeeCompanyRequest;

class EmployeeCompanyController extends Controller
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
     * @param  \App\Http\Requests\StoreEmployeeCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeCompanyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeCompany  $employeeCompany
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeCompany $employeeCompany)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeCompany  $employeeCompany
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeCompany $employeeCompany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeCompanyRequest  $request
     * @param  \App\Models\EmployeeCompany  $employeeCompany
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeCompanyRequest $request, EmployeeCompany $employeeCompany)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeCompany  $employeeCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeCompany $employeeCompany)
    {
        //
    }
}

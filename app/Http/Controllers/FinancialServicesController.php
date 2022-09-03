<?php

namespace App\Http\Controllers;

use App\Models\FinancialService;
use Illuminate\Http\Request;

class FinancialServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        ddd("aaaa");
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FinancialService  $financialService
     * @return \Illuminate\Http\Response
     */
    public function show(FinancialService $financialService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FinancialService  $financialService
     * @return \Illuminate\Http\Response
     */
    public function edit(FinancialService $financialService)
    {
        return $financialService;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FinancialService  $financialService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FinancialService $financialService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FinancialService  $financialService
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinancialService $financialService)
    {
        //
    }
}

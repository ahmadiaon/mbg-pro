<?php

namespace App\Http\Controllers;

use App\Models\SubMenu;
use App\Http\Requests\StoreSubMenuRequest;
use App\Http\Requests\UpdateSubMenuRequest;

class SubMenuController extends Controller
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
     * @param  \App\Http\Requests\StoreSubMenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubMenuRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubMenu  $subMenu
     * @return \Illuminate\Http\Response
     */
    public function show(SubMenu $subMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubMenu  $subMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(SubMenu $subMenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubMenuRequest  $request
     * @param  \App\Models\SubMenu  $subMenu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubMenuRequest $request, SubMenu $subMenu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubMenu  $subMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubMenu $subMenu)
    {
        //
    }
}

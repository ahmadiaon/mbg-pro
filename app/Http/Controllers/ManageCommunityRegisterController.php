<?php

namespace App\Http\Controllers;

use App\Models\CommunityRegister;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ManageCommunityRegisterController extends Controller
{
    public function index()
    {
        // return CommunityRegister::join('communities', 'communities.uuid', '=', 'community_registers.community_uuid')->get(['community_registers.*', 'community_registers.name as nama', 'communities.name']);

        return view('dashboard.manage.communityregister.index', [
            'title'         => 'Community',
        ]);
    }
    public function anyData()
    {
        return Datatables::of(CommunityRegister::join('communities', 'communities.uuid', '=', 'community_registers.community_uuid')->get(['community_registers.*', 'community_registers.name as nama', 'communities.name']))
            ->addColumn('action', function ($model) {
                return '<button onclick="myFunction(' . $model->id . ')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
            })


            ->make(true);
    }
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
     * @param  \App\Models\CommunityRegister  $communityRegister
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityRegister $communityRegister)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunityRegister  $communityRegister
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityRegister $communityRegister)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommunityRegister  $communityRegister
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommunityRegister $communityRegister)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityRegister  $communityRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityRegister $communityRegister)
    {
        CommunityRegister::destroy($communityRegister->id);
        return redirect('/community-registers')->with('success', 'Community Register has been Deleted!');
    }
}

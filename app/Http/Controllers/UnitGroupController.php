<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\UnitGroup;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class UnitGroupController extends Controller
{
    public function anyData()
    {

        return Datatables::of(UnitGroup::join('units', 'units.id', '=', 'unit_groups.unit_id')->get(['units.*', 'unit_groups.*']))
        ->addColumn('action', function ($model) {
            $url = "/admin/unit_group/";
            $url_edit = "'".$url.$model->id."'";
            $url_delete = "'".$url."delete/'";
            return '<input type="hidden" value="'. $model->id .'"><button id="'.$model->id .'" onclick="runEditUnit_group(' . $model->id . ','.$url_edit.')"  class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button>
            <button onclick="isDeleteUnit_group(' . $model->id . ','.$url_delete.',unit_groupTable)"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
        })

        ->make(true);
        
    }
    public function allData()
    {
        
        $units = UnitGroup::all();
        

        return response()->json(['code'=>200, 'message'=>'Data deleted successfully', 'unit_groups' => $units], 200);
    
    }

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
     * @param  \App\Http\Requests\StoreUnitGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'unit_group'      => 'required',
            'capacity'      => 'required',
            'unit_id'      => 'required',
        ]);
        $unitss =  Unit::find($request->unit_id);

         
        $units = UnitGroup::updateOrCreate(['id' => $request->id], [
            'unit_group' => $request->unit_group,
            'capacity'  => $request->capacity,
            'unit_id'   => $request->unit_id
          ]);
          $units['unit'] = $unitss->unit;

          return response()->json(['code'=>200, 'message'=>'Post Created successfully','data' => $units], 200); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnitGroup  $unitGroup
     * @return \Illuminate\Http\Response
     */
    public function show($unit_group)
    {
        $units = Unit::all();
        $unit_groups = UnitGroup::find($unit_group);

        return response()->json(['code'=>200, 'message'=>'Data deleted successfully','data' => $unit_groups, 'units' => $units], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnitGroup  $unitGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitGroup $unitGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUnitGroupRequest  $request
     * @param  \App\Models\UnitGroup  $unitGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnitGroupRequest $request, UnitGroup $unitGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnitGroup  $unitGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($unit_group)
    {
        $data = UnitGroup::where('id', $unit_group)->first();
        $post= UnitGroup::find($unit_group)->delete();
        return response()->json(['code'=>200, 'message'=>'Data deleted successfully','data' => $data], 200);
    }
}

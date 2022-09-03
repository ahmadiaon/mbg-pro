<?php

namespace App\Http\Controllers;

use App\Models\VehicleGroup;
use App\Models\UnitGroup;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class VehicleGroupController extends Controller
{
    public function anyData()
    {
        // return VehicleGroup::join('unit_groups', 'unit_groups.id', '=', 'vehicle_groups.unit_group_id')->get(['unit_groups.*', 'vehicle_groups.*']);
        return Datatables::of(VehicleGroup::join('unit_groups', 'unit_groups.id', '=', 'vehicle_groups.unit_group_id')->get(['unit_groups.*', 'vehicle_groups.*']))
        ->addColumn('action', function ($model) {
            $url = "/admin/vehicle_group/";
            $url_edit = "'".$url.$model->id."'";
            $url_delete = "'".$url."delete/'";
            return '<input type="hidden" value="'. $model->id .'"><button id="'.$model->id .'" onclick="runEditVehicle_group(' . $model->id . ','.$url_edit.')"  class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button>
            <button onclick="isDeletevehicle_group(' . $model->id . ','.$url_delete.')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
        })
        ->make(true);
    }
    public function index()
    {
        //
    }
    public function allData()
    {
        $units = VehicleGroup::all();
        return response()->json(['code'=>200, 'message'=>'Data deleted successfully', 'vehicle_groups' => $units], 200);
    
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_group'      => 'required',
            'unit_group_id'      => 'required',
            'vehicle_code'      => 'required'
        ]);
        $ug = UnitGroup::find($request->unit_group_id);

         
        $units = VehicleGroup::updateOrCreate(['id' => $request->id], [
            'vehicle_group' => $request->vehicle_group,
            'unit_group_id' => $request->unit_group_id,
            'vehicle_code'  => $request->vehicle_code
          ]);
          $units['unit_group'] = $ug->unit_group;

          return response()->json(['code'=>200, 'message'=>'Post Created successfully','data' => $units], 200);

        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleGroup  $vehicleGroup
     * @return \Illuminate\Http\Response
     */
    public function show($vehicle_group)
    {
        $unit_groups = UnitGroup::all();
        $vehicle_groups = VehicleGroup::find($vehicle_group);

        return response()->json(['code'=>200, 'message'=>'Data deleted successfully','data' => $vehicle_groups, 'unit_groups' => $unit_groups], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleGroup  $vehicleGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleGroup $vehicleGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVehicleGroupRequest  $request
     * @param  \App\Models\VehicleGroup  $vehicleGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVehicleGroupRequest $request, VehicleGroup $vehicleGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleGroup  $vehicleGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($vehicleGroup)
    {
        //
        $data = VehicleGroup::where('id', $vehicleGroup)->first();
        $post= VehicleGroup::find($vehicleGroup)->delete();
        return response()->json(['code'=>200, 'message'=>'Data deleted successfully','data' => $data], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleGroup;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    public function anyData()
    {
        // return Vehicle::join('vehicle_groups', 'vehicle_groups.id', '=', 'vehicles.vehicle_group_id')
        // ->join('unit_groups', 'vehicle_groups.unit_group_id', '=', 'unit_groups.id')
        // ->get(['vehicle_groups.*', 'vehicles.*', 'unit_groups.*']);
        return Datatables::of(Vehicle::join('vehicle_groups', 'vehicle_groups.id', '=', 'vehicles.vehicle_group_id')
        ->join('unit_groups', 'vehicle_groups.unit_group_id', '=', 'unit_groups.id')
        ->get(['vehicle_groups.vehicle_group','vehicle_groups.vehicle_code', 'vehicles.*', 'unit_groups.unit_group']))
        ->addColumn('action', function ($model) {
            $url = "/admin/vehicle/";
            $url_edit = "'".$url.$model->id."'";
            $url_delete = "'".$url."delete/'";
            return '<input type="hidden" value="'. $model->id .'"><button id="'.$model->id .'" onclick="runEditVehicle(' . $model->id . ','.$url_edit.')"  class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button>
            <button onclick="isDeletevehicle(' . $model->id . ','.$url_delete.')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
        })
        // ->addColumn('vehicle_group_name', function ($model) {
        //     return '<input type="hidden" value="'. $model->id .'"><button id="'.$model->id .'" onclick="runEditvehicle(' . $model->id . ','.$url_edit.')"  class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button>
        //     <button onclick="isDeletevehicle(' . $model->id . ','.$url_delete.')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
        // })

        ->make(true);
            
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
     * @param  \App\Http\Requests\StoreVehicleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'number'      => 'required',
            'vehicle_group_id'      => 'required',
        ]);
        $unitss =  DB::table('vehicle_groups')
        ->join('unit_groups', 'unit_groups.id', '=', 'vehicle_groups.unit_group_id')
        ->where('vehicle_groups.id', $request->vehicle_group_id)
        ->get()
        ->first();

        
        $units = Vehicle::updateOrCreate(['id' => $request->id], [
            'number' => $request->number,
            'vehicle_group_id'  => $request->vehicle_group_id
          ]);
          $units['vehicle_code'] = $unitss->vehicle_code;
          $units['unit_group'] = $unitss->unit_group;

          return response()->json(['code'=>200, 'message'=>'Post Created successfully','data' => $units], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show($vehicle)
    {
        
        $vehicle_groups = VehicleGroup::all();
        $data = Vehicle::find($vehicle);

        return response()->json(['code'=>200, 'message'=>'Data deleted successfully','data' => $data, 'vehicle_groups' => $vehicle_groups], 200);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVehicleRequest  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($vehicle)
    {
        $data = Vehicle::where('id', $vehicle)->first();
        $post= Vehicle::find($vehicle)->delete();
        return response()->json(['code'=>200, 'message'=>'Data deleted successfully','data' => $data], 200);
    
    }
}

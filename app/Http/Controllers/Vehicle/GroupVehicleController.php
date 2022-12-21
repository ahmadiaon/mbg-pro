<?php

namespace App\Http\Controllers\Vehicle;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Vehicle\GroupVehicle;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GroupVehicleController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'group-vehicle'
        ];

        return view('GroupVehicle.index', [
            'title'         => 'Group Unit',
            'layout'    => $layout
        ]);
    }

    public function delete(Request $request)
    {
         $store = GroupVehicle::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data GroupVehicle  deleted');
    }


    public function anyData(){
        $data = GroupVehicle::all();
        return DataTables::of($data)    
        ->make(true);
    }


    public function store(Request $request){

        if(empty($request->uuid)){
            $request->uuid = ResponseFormatter::toUUID($request->group_code);
        }
        $strore = GroupVehicle::updateOrCreate(['uuid' => $request->uuid], 
        [
            'group_code' => $request->group_code,
            'group_name' => $request->group_name,
            'date_start'    => $request->date_start,
            'date_end'    => $request->date_end,
        ]);
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }

  
    public function show(Request $request){
        $data = GroupVehicle::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Privilege');
    }
}

<?php

namespace App\Http\Controllers\Vehicle;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Vehicle\Status;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StatusController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'logistic-status'
        ];

        return view('Status.index', [
            'title'         => 'Status',
            'layout'    => $layout
        ]);
    }

    public function delete(Request $request)
    {
         $store = Status::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data Status  deleted');
    }


    public function anyData(){
        $data = Status::all();
        return DataTables::of($data)    
        ->make(true);
    }


    public function store(Request $request){

        if(empty($request->uuid)){
            $request->uuid = ResponseFormatter::toUUID($request->status);
        }
        $strore = Status::updateOrCreate(['uuid' => $request->uuid], 
        [
            'status' => $request->status
        ]);
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }

  
    public function show(Request $request){
        $data = Status::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Privilege');
    }
}

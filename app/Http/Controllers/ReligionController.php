<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Religion;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ReligionController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'religion'
        ];
        return view('religion.index', [
            'title'         => 'Database Agama',
            'layout'    => $layout
        ]);
    }
    public function anyData(){
        $data = Religion::all();
        return Datatables::of($data)    
        ->make(true);
    }
    public function show(Request $request){
        $data = Religion::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Privilege');
    }

    public function delete(Request $request)
    {
         $store = Religion::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data Privilege');
    }


    public function store(Request $request){
        if(empty($request->uuid)){
            $request->uuid = ResponseFormatter::toUUID($request->religion);
        }
        $strore = Religion::updateOrCreate(['uuid' => $request->uuid], 
        [
            'religion' => $request->religion,
        ]);
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }
}
